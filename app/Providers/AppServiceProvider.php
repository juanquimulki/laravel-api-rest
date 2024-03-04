<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use App\Services\_IUserService as IUserService;
use App\Services\UserService;
use App\Services\_IGiphyService as IGiphyService;
use App\Services\GiphyService;
use App\Services\_ISavedGifService as ISavedGifService;
use App\Services\SavedGifService;
use App\Services\_IServiceRequestService as IServiceRequestService;
use App\Services\ServiceRequestService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserService::class,           UserService::class);
        $this->app->bind(IGiphyService::class,          GiphyService::class);
        $this->app->bind(ISavedGifService::class,       SavedGifService::class);
        $this->app->bind(IServiceRequestService::class, ServiceRequestService::class);

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
