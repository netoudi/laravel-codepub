<?php

namespace Modules\CodeUser\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PermissionReader
 *
 * @package Modules\CodeUser\Facades
 */
class PermissionReader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Modules\CodeUser\Annotations\PermissionReader::class;
    }
}
