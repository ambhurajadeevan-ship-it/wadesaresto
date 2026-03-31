<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Reservasi;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    
    public function boot()
    {
        Paginator::useBootstrapFive();
        
        View::composer('layouts.admin', function ($view) {
            $notifikasi = Reservasi::where('status','pending')
                                ->latest()
                                ->take(5)
                                ->get();

            $view->with('notifikasi', $notifikasi) 
                ->with('notifCount' , $notifikasi->count());
        });

        ResetPassword::createUrlUsing(function ($notifiable, string $token) {
            return url(route('admin.password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
        });
    }
}