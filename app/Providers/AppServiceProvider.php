<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use App\Services\IUserService;
use App\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserService::class, UserService::class);

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
