<?php

namespace CodePub\Repositories;

use CodePub\Models\Book;
use CodePub\Validators\BookValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class BookRepositoryEloquent
 *
 * @package namespace CodePub\Repositories;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{
    use BaseRepositoryTrait;

    protected $fieldSearchable = [
        'title' => 'like',
        'user.name' => 'like',
    ];

    public function create(array $attributes)
    {
        $model = parent::create($attributes);
        $model->categories()->sync($attributes['categories']);

        return $model;
    }

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        $model->categories()->sync($attributes['categories']);

        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
