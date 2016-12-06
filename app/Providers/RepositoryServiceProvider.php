<?php

namespace CodePub\Providers;

use CodePub\Repositories\BookRepository;
use CodePub\Repositories\BookRepositoryEloquent;
use CodePub\Repositories\CategoryRepository;
use CodePub\Repositories\CategoryRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(BookRepository::class, BookRepositoryEloquent::class);
    }
}