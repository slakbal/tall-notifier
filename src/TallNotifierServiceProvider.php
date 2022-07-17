<?php

namespace Slakbal\TallNotifier;

use Livewire\Livewire;
// use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Slakbal\TallNotifier\Http\Livewire\Notifier;
use Slakbal\TallNotifier\Http\Livewire\NotifierMessage;
use Slakbal\TallNotifier\Console\Commands\TallNotifierInstall;

class TallNotifierServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        Livewire::component('notifier', Notifier::class);
        Livewire::component('notifier-message', NotifierMessage::class);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-notifier');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tall-notifier.php', 'tall-notifier');

        // Register the service the package provides.
        // $this->app->singleton('tall-notifier', function ($app) {
        //     return new TallNotifier;
        // });
    }

    // /**
    //  * Get the services provided by the provider.
    //  *
    //  * @return array
    //  */
    // public function provides()
    // {
    //     return ['tall-notifier'];
    // }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/tall-notifier.php' => config_path('tall-notifier.php'),
        ], 'tall-notifier.config');

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/tall-notifier'),
        ], 'tall-notifier.views');

        // Registering package commands.
        $this->commands([TallNotifierInstall::class]);
    }
}
