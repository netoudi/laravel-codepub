<?php

namespace Modules\CodeBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderByOrderCriteria
 *
 * @package Modules\CodeUser\Criteria
 */
class OrderByOrderCriteria implements CriteriaInterface
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
        return $model->orderBy('order', 'asc');
    }
}
