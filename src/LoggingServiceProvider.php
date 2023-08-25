<?php

namespace StarringJane\Logging;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LoggingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/sj-logging.php' => config_path('sj-logging.php'),
        ], 'config');
    }
}
