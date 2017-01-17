<?php

namespace Modules\CodeUser\Repositories;

trait BaseRepositoryTrait
{
    public function lists($column, $key = null)
    {
        $this->applyCriteria();

        return $this->model->pluck($column, $key);
    }
}
