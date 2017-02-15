<?php

namespace Modules\CodeUser\Repositories;

use CodePub\Criteria\CriteriaTrashedTrait;
use Modules\CodeUser\Models\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent
 *
 * @package namespace CodePub\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    use BaseRepositoryTrait, CriteriaTrashedTrait, RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'name' => 'like',
    ];

    public function create(array $attributes)
    {
        $model = parent::create($attributes);
        $model->roles()->sync($attributes['roles']);

        return $model;
    }

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        $model->roles()->sync($attributes['roles']);

        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
