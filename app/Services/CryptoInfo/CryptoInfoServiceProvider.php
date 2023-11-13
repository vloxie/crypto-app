<?php

namespace App\Services\CryptoInfo;

use Illuminate\Support\ServiceProvider;

class CryptoInfoServiceProvider extends ServiceProvider
{

    public function register():void
    {
        $this->app->singleton(DriverManager::class, function ($app) {
            return new DriverManager($app);
        });
    }
}
