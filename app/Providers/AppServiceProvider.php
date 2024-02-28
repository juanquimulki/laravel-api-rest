<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $giphyUrl = env('GIPHY_URL');

        $this->app->singleton(Client::class, function($app) use ($giphyUrl) {
            return new Client(['base_uri' => $giphyUrl]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
