<?php

namespace Modules\CodeUser\Console;

use Illuminate\Console\Command;
use Modules\CodeUser\Annotations\PermissionReader;
use Modules\CodeUser\Repositories\PermissionRepository;

class CreatePermissionsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'codeuser:make-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating permissions based on controller and actions.';

    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * @var PermissionReader
     */
    private $permissionReader;

    /**
     * Create a new command instance.
     *
     * @param PermissionRepository $permissionRepository
     * @param PermissionReader $permissionReader
     */
    public function __construct(PermissionRepository $permissionRepository, PermissionReader $permissionReader)
    {
        parent::__construct();
        $this->permissionRepository = $permissionRepository;
        $this->permissionReader = $permissionReader;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $permissions = $this->permissionReader->getPermissions();

        foreach ($permissions as $permission) {
            if (!$this->existsPermission($permission)) {
                $this->permissionRepository->create($permission);
            }
        }

        $this->info("<info>Loaded permissions...</info>");
    }

    private function existsPermission($permission)
    {
        $permission = $this->permissionRepository->findWhere([
            'name' => $permission['name'],
            'resource_name' => $permission['resource_name'],
        ])->first();

        return $permission != null;
    }
}
