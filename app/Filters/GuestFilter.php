<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GuestFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session('logged_in')) {
            return redirect()->route('dashboard');
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
