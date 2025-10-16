<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session('logged_in')) {
            return;
        }
        
        if ($this->tryRemember()) {
            return;
        }
        
        return redirect()->route('auth.login')
        ->with('error', 'Inicia sesión para continuar');
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
    
    private function tryRemember(): bool
    {
        $cookie = request()->getCookie('remember');
        if (! $cookie) return false;
        
        $raw = base64_decode($cookie, true);
        if ($raw === false) return false;
        
        try {
            $json    = service('encrypter')->decrypt($raw);
            $payload = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Throwable) {
            response()->deleteCookie('remember', '/');
            return false;
        }
        
        if (! isset($payload['uid'], $payload['exp'])) return false;
        if (time() > (int)$payload['exp']) {
            response()->deleteCookie('remember', '/');
            return false;
        }
        $users = model(UserModel::class);
        $user = $users->where('email', $payload['email'])->first();
        
        if (! $user) {
            response()->deleteCookie('remember', '/');
            return false;
        }
        
        session()->regenerate();
        session()->set([
            'uid' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'] ?? 'student',
            'avatar' => $user['image_path'] ?? '',
            'logged_in' => true,
        ]);
        
        $newPayload = [
            'uid' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'] ?? 'student',
            'avatar' => $user['image_path'] ?? '',
            'logged_in' => true,
        ];
        
        $enc = service('encrypter')->encrypt(json_encode($newPayload));
        response()->setCookie(
            name: 'remember',
            value: base64_encode($enc),
            expire: 60*60*24*30,
            path: '/',
            domain: '',
            secure: ENVIRONMENT === 'production',
            httponly: true,
            samesite: 'Lax'
        );
        
        return true;
    }
}
