<?php

namespace Modules\CodeUser\Http\Controllers;

use Illuminate\Http\Request;
use Modules\CodeUser\Http\Requests\UserRequest;
use Modules\CodeUser\Models\User;
use Modules\CodeUser\Repositories\CategoryRepository;
use Modules\CodeUser\Repositories\UserRepository;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
        $users = $this->userRepository->paginate(10);

        return view('codeuser::users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeuser::users.form');
    }

    /**
     * Store a newly created resource in storage.
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
     *
     * @param \Modules\CodeUser\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('codeuser::users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param \Modules\CodeUser\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->userRepository->update($request->only(['name', 'email']), $user->id);

        return redirect()->to($request->get('_previous'))->with('success', 'Usuário alterado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param \Modules\CodeUser\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return redirect()->to($request->get('_previous'))->with('success', 'Usuário excluído com sucesso');
    }
}
