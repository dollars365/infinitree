<?php

namespace Encore\infinitree;

use Illuminate\Support\ServiceProvider;

class infinitreeServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(infinitree $extension)
    {
        if (! infinitree::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'infinitree');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/infinitree')],
                'infinitree'
            );
        }

        $this->app->booted(function () {
            infinitree::routes(__DIR__.'/../routes/web.php');
        });
    }
}