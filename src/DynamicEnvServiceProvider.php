<?php

namespace OmeneJoseph\DynamicEnv;

use Illuminate\Support\ServiceProvider;
use OmeneJoseph\DynamicEnv\Commands\FetchEnvironmentSecretsCommand;
use OmeneJoseph\DynamicEnv\Commands\SyncEnvVariablesCommand;

class DynamicEnvServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'dynamic-env');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'dynamic-env');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('dynamic-env.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/dynamic-env'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/dynamic-env'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/dynamic-env'),
            ], 'lang');*/

            // Registering package commands.
             $this->commands([
                 SyncEnvVariablesCommand::class,
                 FetchEnvironmentSecretsCommand::class
             ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'dynamic-env');

        // Register the main class to use with the facade
        $this->app->singleton('dynamic-env', function () {
            return new DynamicEnv;
        });
    }
}
