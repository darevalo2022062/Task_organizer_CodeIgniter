<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\EmailVerificationModel;
use CodeIgniter\I18n\Time;

class AuthMail extends BaseController
{
    public function mailVerifyView()
    {
        $blade = service(name: 'blade');
        return $blade->render('auth.mail_verify');
    }
    public function sendEmailVerification(array $user): bool
    {
        helper('url');
        
        $token = bin2hex(random_bytes(32));
        $hash = hash('sha256', $token);
        $blade = service('blade');
        
        $emailVerificationModel = model(EmailVerificationModel::class);
        
        $emailVerificationModel->insert([
            'user_id' => $user['id'],
            'token_hash' => $hash,
            'expires_at' => Time::now()->addHours(24)->toDateTimeString(),
        ]);
        
        $verifyUrl = url_to('verify-email', $user['id'], $token);
        
        $email = service('email');
        
        $email->setFrom(config('Email')->fromEmail, config('Email')->fromName);
        
        $email->setMailType('html');
        $email->setNewline("\r\n");
        $email->setCRLF("\r\n");
        
        $email->setTo($user['email']);
        $email->setSubject(lang('App.auth.email.verify_subject') ?? 'Confirma tu correo');
        $email->setMessage($blade->render('emails.verify', [
            'name' => $user['name'],
            'verifyUrl' => $verifyUrl,
        ]));
        
        if (!$email->send()) {
            log_message('error', 'Email send failed: {debug}', [
                'debug' => print_r($email->printDebugger(['headers', 'subject', 'body']), true),
            ]);
            return false;
        }
        
        return true;
    }
    public function verifyEmail(int $userId, string $token)
    {
        $verifs = model(EmailVerificationModel::class);
        $users = model(UserModel::class);
        
        $row = $verifs->where('user_id', $userId)
        ->where('used_at', null)
        ->orderBy('id', 'desc')
        ->first();
        
        if (!$row)
            return redirect()->to('auth/login')->with('error', lang('App.auth.login.error.email_verified_link'));
        if (Time::now()->isAfter($row['expires_at']))
            return redirect()->to('auth/login')->with('error', lang('App.auth.login.error.email_verified_link'));
        if (!hash_equals($row['token_hash'], hash('sha256', $token)))
            return redirect()->to('auth/login')->with('error', lang('App.auth.login.error.email_verified_link'));
        $user = $users->find($userId);
        if (!$user)
            return redirect()->to('auth/login')->with('error', lang('App.auth.login.error.email_verified_link'));
        if (empty($user['confirm_email_at'])) {
            $users->update($userId, ['confirm_email_at' => Time::now()->toDateTimeString()]);
        }
        $verifs->update($row['id'], ['used_at' => Time::now()->toDateTimeString()]);
        return redirect()->to('auth/login')->with('success', lang('App.auth.login.verified'));
    }
}
