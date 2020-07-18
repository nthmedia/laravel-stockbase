<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase;

use Illuminate\Support\ServiceProvider;
use Nthmedia\Stockbase\DivideIQ\DivideIQ;

class StockbaseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/stockbase.php' => base_path('config/stockbase.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->app->singleton(DivideIQ::class, function ($app) {
            return new DivideIQ(
                config('stockbase.username'),
                config('stockbase.password'),
                config('stockbase.endpoint')
            );
        });

        $this->app->bind('stockbase', function () {
            return resolve(StockbaseClient::class);
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/stockbase.php', 'stockbase');
    }
}
