<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'dyg59mvvpt7w4w3p',
                    'publicKey' => '8p8mybxdgdfz6zz2',
                    'privateKey' => '83fda6b33fec02ea3f6e4576a30e9974'
                ]
            );
        });
    }
}