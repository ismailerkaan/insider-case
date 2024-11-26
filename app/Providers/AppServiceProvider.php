<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Contracts\Service\SentMessageWebhookServiceInterface::class,
            \App\Services\SentMessageWebhookService::class
        );

        $this->app->bind(
            \App\Contracts\Service\SendMessageServiceInterface::class,
            \App\Services\SendMessageService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
