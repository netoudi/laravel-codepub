<?php

namespace Modules\CodeUser\Annotations;

use Doctrine\Common\Annotations\Reader;
use Modules\CodeUser\Annotations\Mapping\Action;
use Modules\CodeUser\Annotations\Mapping\Controller;

class PermissionReader
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * PermissionReader constructor.
     *
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function getPermissions()
    {
        $controllersClasses = $this->getControllers();
        $declared = get_declared_classes();
        $permissions = [];

        foreach ($declared as $className) {
            $rc = new \ReflectionClass($className);

            if (in_array($rc->getFileName(), $controllersClasses)) {
                $permission = $this->getPermission($className);

                if (count($permission)) {
                    $permissions = array_merge($permissions, $permission);
                }
            }
        }

        return $permissions;
    }

    public function getPermission($controllerClass, $action = null)
    {
        $rc = new \ReflectionClass($controllerClass);
        /** @var Controller $controllerAnnotation */
        $controllerAnnotation = $this->reader->getClassAnnotation($rc, Controller::class);
        $permissions = [];

        if ($controllerAnnotation) {
            $permission = [
                'name' => $controllerAnnotation->name,
                'description' => $controllerAnnotation->description,
            ];

            $rcMethods = !$action ? $rc->getMethods() : [$rc->getMethod($action)];

            foreach ($rcMethods as $rcMethod) {
                /** @var Action $actionAnnotation */
                $actionAnnotation = $this->reader->getMethodAnnotation($rcMethod, Action::class);

                if ($actionAnnotation) {
                    $permission['resource_name'] = $actionAnnotation->name;
                    $permission['resource_description'] = $actionAnnotation->description;
                    $permissions[] = (new \ArrayIterator($permission))->getArrayCopy();
                }
            }
        }

        return $permissions;
    }

    /**
     * @return array
     */
    private function getControllers()
    {
        $dirs = config('codeuser.acl.controllers_annotations');
        $files = [];

        foreach ($dirs as $dir) {
            foreach (\File::allFiles($dir) as $file) {
                $files[] = $file->getRealPath();
                require_once $file->getRealPath();
            }
        }

        return $files;
    }
}