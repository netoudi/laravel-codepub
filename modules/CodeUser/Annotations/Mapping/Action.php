<?php

namespace Modules\CodeUser\Annotations\Mapping;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Action
{
    public $name;

    public $description;
}
