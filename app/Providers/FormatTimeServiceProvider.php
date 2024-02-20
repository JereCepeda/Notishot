<?php

namespace App\Providers;

use App\Helpers\FormatTime;
use Illuminate\Support\ServiceProvider;

class FormatTimeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FormatTime::class,function($app) {
            return new FormatTime($app[]);
        });
        // require app_path().'/Helpers/FormatTime.php';
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
