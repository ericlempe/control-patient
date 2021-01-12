<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Models\User;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    
    /**
     * View listar usuários
     *
     * @return view
     */
    public function index()
    {
        
        # verificando permissão em policy
        // $this->authorize('index', User::class);


        return view('admin.users.list');
    }

    /**
     * Informações para datatables
     *
     * @return datatable
     */
    public function datatables(UserService $userService)
    {
        //verificando permissão em policy
        // $this->authorize('index', User::class);

        //obtendo informações para datatable
        $users = $userService->selectDataTable();

        //instancia datatables
        $datatables =  Datatables::of($users);

        //configurando colunas
        $datatables
            ->addColumn('action', function ($user) {
                // $edit = view('partials.components.action', ['action' => 'edit', 'route' => route('admin.users.edit', ['user' => $user->id]), 'ability' => 'admin-users-update', 'class' => 'list-icons-item ' . IconsHelper::getColor('update'), 'classIcon' => IconsHelper::getIcon('update'), 'title' => __('app.actions.labels.edit')])->render();
                // $delete = view('partials.components.action', ['action' => 'delete', 'route' => route('admin.users.destroy', ['user' => $user->id]), 'ability' => 'admin-users-delete', 'class' => 'btn-removal list-icons-item ' . IconsHelper::getColor('delete'), 'classIcon' => IconsHelper::getIcon('delete'), 'title' => __('app.actions.labels.delete') ])->render();

             
                // return '<div class="list-icons">' . $edit . $delete . '</div>';
                return '<div class="list-icons"></div>';
            });
           
        //retornando datatables
        return $datatables->make(true);
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //verificando permissão em policy
        $this->authorize('create', User::class);

        //obtendo perfis de acordo com perfil do user logado
        $roles = $this->RoleRepository->listar();
        
        //redirecionando
        return view('admin.administracao.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\Users\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //verificando permissão em policy
        $this->authorize('create', User::class);

        //enviado para repositorio info do form
        $user = $this->UserRepository->store($request);

        //verificando se salvou para redirecionar
        if($user)
            return redirect(route('admin.users.index'));

        return back()->withInput();
    }

    /**
     * Show the form for editing User
     *
     * @param  int  $id - id do usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //verificando permissão em policy
        $this->authorize('update', User::class);

        //obtendo registro
        $user = $this->UserRepository->find($id);

        //obtendo perfis de acordo com perfil do user logado
        $roles = $this->RoleRepository->listar();

        //redirecionando com variaveis
        return view('admin.administracao.users.edit', compact('user', 'roles'));
    }

    /**
     * Update User
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  int  $id - id do usuario
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        //verificando permissão em policy
        $this->authorize('update', User::class);

        //redirecionando de acordo com o resultado do update
        if($this->UserRepository->update($request, $id))
            return redirect(route('admin.users.index'));

        return back()->withInput();
    }

    /**
     * Delete User
     *
     * @param  int  $id - id do usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::class);
        return $this->UserRepository->delete($id);
    }
}