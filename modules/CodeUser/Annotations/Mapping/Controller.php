<?php

namespace Modules\CodeUser\Annotations\Mapping;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Controller
{
    public $name;

    public $description;
}
