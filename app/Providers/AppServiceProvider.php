<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Models\ActivityLog;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Increase PHP execution time for better performance
        ini_set('max_execution_time', 300); // 5 minutes
        ini_set('max_input_time', 300);

        // Share live cart count with main layout/navbar
        View::composer('layouts.app', function ($view) {
            $cartCount = 0;

            if (Auth::check()) {
                $cartCount = (int) Cart::where('user_id', Auth::id())->sum('quantity');
            }

            $view->with('cartCount', $cartCount);
        });

        // Listen for login/logout events and record activity
        // Temporarily disabled to debug timeout issue
        /* 
        Event::listen(Login::class, function (Login $event) {
            try {
                ActivityLog::create([
                    'user_id' => $event->user->id ?? null,
                    'type' => 'login',
                    'ip' => request()->ip(),
                    'user_agent' => request()->header('User-Agent')
                ]);
            } catch (\Throwable $e) {
                // don't break application on logging failure
            }
        });

        Event::listen(Logout::class, function (Logout $event) {
            try {
                ActivityLog::create([
                    'user_id' => $event->user->id ?? null,
                    'type' => 'logout',
                    'ip' => request()->ip(),
                    'user_agent' => request()->header('User-Agent')
                ]);
            } catch (\Throwable $e) {
                // ignore
            }
        });
        */
    }
}
