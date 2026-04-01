<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        // Kalau request expecting JSON (AJAX), tidak perlu redirect
        if ($request->expectsJson()) {
            return null;
        }

        // Route admin → login admin
        if ($request->is('admin/*')) {
            return route('admin.login');
        }

        // Route customer → login customer
        // Laravel akan menyimpan URL yang dituju ke session (intended URL)
        // sehingga setelah login user kembali ke halaman yang diminta
        return route('login');
    }
}