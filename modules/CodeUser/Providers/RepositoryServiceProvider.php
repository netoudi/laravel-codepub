<?php

namespace Modules\CodeUser\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CodeUser\Repositories\RoleRepository;
use Modules\CodeUser\Repositories\RoleRepositoryEloquent;
use Modules\CodeUser\Repositories\UserRepository;
use Modules\CodeUser\Repositories\UserRepositoryEloquent;

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
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(RoleRepository::class, RoleRepositoryEloquent::class);
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
