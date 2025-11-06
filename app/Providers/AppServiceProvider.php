<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Filesystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Fallback jika binding "files" hilang
        if (! $this->app->bound('files')) {
            $this->app->singleton('files', function () {
                return new Filesystem;
            });
    }
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        Schema::defaultStringLength(191);
    }

}
