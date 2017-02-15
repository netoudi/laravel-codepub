<?php

namespace Modules\CodeUser\Http\Controllers;

use Illuminate\Http\Request;
use Modules\CodeUser\Annotations\Mapping as Permission;
use Modules\CodeUser\Http\Requests\UserRequest;
use Modules\CodeUser\Models\User;
use Modules\CodeUser\Repositories\CategoryRepository;
use Modules\CodeUser\Repositories\RoleRepository;
use Modules\CodeUser\Repositories\UserRepository;

/**
 * @Permission\Controller(name="users-admin", description="Administração de usuários")
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="Ver listagem de usuários")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = $this->userRepository->paginate(10);

        return view('codeuser::users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Criar usuários")
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->all()->pluck('name', 'id');

        return view('codeuser::users.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Criar usuários")
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $this->userRepository->create($data);

        return redirect()->to($request->get('_previous'))->with('success', 'Usuário cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     * @Permission\Action(name="list", description="Ver listagem de usuários")
     *
     * @param \Modules\CodeUser\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('codeuser::users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar usuários")
     *
     * @param \Modules\CodeUser\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = $this->roleRepository->all()->pluck('name', 'id');

        return view('codeuser::users.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar usuários")
     *
     * @param UserRequest $request
     * @param \Modules\CodeUser\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->userRepository->update($request->only(['name', 'email', 'roles']), $user->id);

        return redirect()->to($request->get('_previous'))->with('success', 'Usuário alterado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir usuários")
     *
     * @param UserRequest $request
     * @param \Modules\CodeUser\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRequest $request, User $user)
    {
        $user->delete();

        return redirect()->to($request->get('_previous'))->with('success', 'Usuário excluído com sucesso');
    }
}
