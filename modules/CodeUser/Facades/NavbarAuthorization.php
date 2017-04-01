<?php

namespace Modules\CodeUser\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class NavbarAuthorization
 *
 * @package Modules\CodeUser\Facades
 */
class NavbarAuthorization extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Modules\CodeUser\Menu\Navbar::class;
    }
}
