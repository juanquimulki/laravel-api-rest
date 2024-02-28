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
        $giphyUrl    = env('GIPHY_URL');
        $giphyApiKey = env('GIPHY_APIKEY');

        $this->app->singleton(Client::class, function($app) use ($giphyUrl, $giphyApiKey) {
            return new Client(['base_uri' => $giphyUrl,     
                'defaults' => [
                    'query'  => [
                        'api_key' => $giphyApiKey,
                    ]
                ]
            ]);
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
