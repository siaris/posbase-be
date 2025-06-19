<?php

namespace App\Providers;
use App\Services\Auth\AuthService;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('auth.service', function($app) {
            // Default company bisa dari domain atau header request
            // $company = Company::where('domain', request()->getHost())->firstOrFail();
            return new AuthService($app);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
