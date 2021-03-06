<?php

namespace Modules\CodeBook\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CodeBook\Repositories\BookRepository;
use Modules\CodeBook\Repositories\BookRepositoryEloquent;
use Modules\CodeBook\Repositories\CategoryRepository;
use Modules\CodeBook\Repositories\CategoryRepositoryEloquent;
use Modules\CodeBook\Repositories\ChapterRepository;
use Modules\CodeBook\Repositories\ChapterRepositoryEloquent;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(BookRepository::class, BookRepositoryEloquent::class);
        $this->app->bind(ChapterRepository::class, ChapterRepositoryEloquent::class);
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
