<?php

namespace App\Providers;

use App\Classes\SmsRu;
use Illuminate\Support\ServiceProvider;

class SmsRuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('smsru', function ($app) {
            return new SmsRu();
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
