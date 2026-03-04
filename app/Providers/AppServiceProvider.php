<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Models\ActivityLog;

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
        // Listen for login/logout events and record activity
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
    }
}
