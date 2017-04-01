<?php

namespace Modules\CodeUser\Repositories;

use CodePub\Criteria\CriteriaTrashedTrait;
use Modules\CodeUser\Models\Role;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RoleRepositoryEloquent
 *
 * @package namespace CodePub\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    use BaseRepositoryTrait, CriteriaTrashedTrait, RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'name' => 'like',
        'description' => 'like',
    ];

    public function updatePermissions(array $permissions, $roleId)
    {
        $model = $this->find($roleId);
        $model->permissions()->detach();

        if (count($permissions)) {
            $model->permissions()->sync($permissions);
        }

        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
