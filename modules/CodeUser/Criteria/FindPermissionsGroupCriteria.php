<?php

namespace Modules\CodeUser\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindPermissionsGroupCriteria
 *
 * @package Modules\CodeUser\Criteria
 */
class FindPermissionsGroupCriteria implements CriteriaInterface
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
        return $model->groupBy('name', 'description');
    }
}
