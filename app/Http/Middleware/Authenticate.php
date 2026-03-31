<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Route admin → login admin
        if ($request->is('admin/*')) {
            return route('admin.login');
        }

        // Route customer → login customer
        return route('login');
    }
}