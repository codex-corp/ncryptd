<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Auth\SsoAuth;

class SsoAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('sentry', function ($app) {
            return $app->make(SsoAuth::class);
        });
    }
}
