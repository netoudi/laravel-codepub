<?php

namespace Modules\Codeuser\Repositories;

use CodePub\Criteria\CriteriaTrashedTrait;
use Modules\Codeuser\Models\Permission;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PermissionRepositoryEloquent
 *
 * @package namespace CodePub\Repositories;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    use BaseRepositoryTrait, CriteriaTrashedTrait, RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'name' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
