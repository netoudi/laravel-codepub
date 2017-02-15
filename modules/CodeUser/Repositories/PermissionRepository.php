<?php

namespace Modules\CodeUser\Repositories;

use CodePub\Criteria\CriteriaTrashedInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PermissionRepository
 *
 * @package namespace CodePub\Repositories;
 */
interface PermissionRepository extends RepositoryInterface, RepositoryCriteriaInterface, CriteriaTrashedInterface, RepositoryRestoreInterface
{
    //
}
