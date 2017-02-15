<?php

namespace Modules\CodeUser\Console;

use Illuminate\Console\Command;
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
     * Create a new command instance.
     *
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        parent::__construct();
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $permissions = \PermissionReader::getPermissions();

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
