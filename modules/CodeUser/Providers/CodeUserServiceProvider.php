<?php

namespace Modules\CodeUser\Providers;

use Illuminate\Support\ServiceProvider;

class CodeUserServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerMigrations();
        $this->registerSeeds();
        $this->registerFactories();
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/codeuser');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'codeuser');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'codeuser');
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('codeuser.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'codeuser'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/codeuser');

        $sourcePath = __DIR__ . '/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/codeuser';
        }, \Config::get('view.paths')), [$sourcePath]), 'codeuser');
    }

    /**
     * Register migrations.
     *
     * @return void
     */
    public function registerMigrations()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');
    }

    /**
     * Register seeders.
     *
     * @return void
     */
    public function registerSeeds()
    {
        $this->publishes([
            __DIR__ . '/../database/seeds' => database_path('seeds'),
        ], 'seeds');
    }

    /**
     * Register factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        $this->publishes([
            __DIR__ . '/../database/factories' => database_path('factories'),
        ], 'factories');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}