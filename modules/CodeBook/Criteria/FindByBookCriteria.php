<?php

namespace Modules\CodeBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByBookCriteria
 *
 * @package Modules\CodeUser\Criteria
 */
class FindByBookCriteria implements CriteriaInterface
{
    /**
     * @var
     */
    private $bookId;

    /**
     * FindByBookCriteria constructor.
     *
     * @param integer $bookId
     */
    public function __construct($bookId)
    {
        $this->bookId = $bookId;
    }

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
        return $model->where('book_id', $this->bookId);
    }
}
