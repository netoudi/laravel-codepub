<?php

namespace Modules\CodeBook\Providers;

use Folklore\Image\ImageServiceProvider;
use Illuminate\Support\ServiceProvider;

class CodeBookServiceProvider extends ServiceProvider
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
        $this->publishAssets();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(ImageServiceProvider::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Image', \Folklore\Image\Facades\Image::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('codebook.php'),
            __DIR__ . '/../config/config.yml' => storage_path('app/books/template/config.yml'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'codebook'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/codebook');

        $sourcePath = __DIR__ . '/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/codebook';
        }, \Config::get('view.paths')), [$sourcePath]), 'codebook');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/codebook');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'codebook');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'codebook');
        }
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
     * Publish assets.
     *
     * @return void
     */
    public function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/../resources/assets/js' => public_path('js'),
        ], 'assets');
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