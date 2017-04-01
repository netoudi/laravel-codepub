<?php

namespace Modules\CodeBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindBooksAuthorCriteria
 *
 * @package Modules\CodeUser\Criteria
 */
class FindByAuthorCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (!\Auth::user()->can(config('codebook.acl.permissions.book_manage_all'))) {
            return $model->where('user_id', \Auth::user()->id);
        }

        return $model;
    }
}
