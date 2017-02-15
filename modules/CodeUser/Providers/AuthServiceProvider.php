<?php

namespace Modules\CodeUser\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\CodeUser\Criteria\FindPermissionsResourceCriteria;
use Modules\CodeUser\Repositories\PermissionRepository;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CodePub\Model' => 'CodePub\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::before(function ($user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        $permissionRepository = app(PermissionRepository::class);
        $permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
        $permissions = $permissionRepository->all();

        foreach ($permissions as $permission) {
            \Gate::define("{$permission->name}/{$permission->resource_name}", function ($user) use ($permission) {
                return $user->hasRole($permission->roles);
            });
        }
    }
}
