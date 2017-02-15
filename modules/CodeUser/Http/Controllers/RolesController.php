<?php

namespace Modules\CodeUser\Http\Controllers;

use Illuminate\Http\Request;
use Modules\CodeUser\Criteria\FindPermissionsGroupCriteria;
use Modules\CodeUser\Criteria\FindPermissionsResourceCriteria;
use Modules\CodeUser\Http\Requests\PermissionRequest;
use Modules\CodeUser\Http\Requests\RoleRequest;
use Modules\CodeUser\Models\Role;
use Modules\CodeUser\Repositories\CategoryRepository;
use Modules\CodeUser\Repositories\PermissionRepository;
use Modules\CodeUser\Repositories\RoleRepository;

class RolesController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * RolesController constructor.
     *
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $roles = $this->roleRepository->paginate(10);

        return view('codeuser::roles.index', compact('roles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeuser::roles.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->roleRepository->create($request->all());

        return redirect()->to($request->get('_previous'))->with('success', 'Papel cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param \Modules\CodeUser\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('codeuser::roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Modules\CodeUser\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('codeuser::roles.form', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param \Modules\CodeUser\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->roleRepository->update($request->all(), $role->id);

        return redirect()->to($request->get('_previous'))->with('success', 'Papel alterado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RoleRequest $request
     * @param \Modules\CodeUser\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleRequest $request, Role $role)
    {
        $role->delete();

        return redirect()->to($request->get('_previous'))->with('success', 'Papel excluído com sucesso');
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPermissions(Role $role)
    {
        $this->permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
        $permissions = $this->permissionRepository->all();

        $this->permissionRepository->resetCriteria();
        $this->permissionRepository->pushCriteria(new FindPermissionsGroupCriteria());
        $permissionsGroup = $this->permissionRepository->all(['name', 'description']);

        return view('codeuser::roles.permissions', compact('role', 'permissions', 'permissionsGroup'));
    }

    /**
     * @param PermissionRequest $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePermissions(PermissionRequest $request, Role $role)
    {
        if ($request->get('permissions')) {
            $role->permissions()->sync($request->get('permissions'));
        } else {
            $role->permissions()->sync([]);
        }

        return redirect()->route('roles.index')->with('success', 'Permissões atualizadas com sucesso');
    }
}
