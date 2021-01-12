<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Models\User;
use Datatables;

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
        $this->authorize('index', User::class);

        # obtendo perfil
        $perfil = auth()->user()->getRoles()[0];

        # obtendo perfis de acordo com perfil do user logado
        $roles = $this->UserService->listar($perfil)->put('','');

        # status
        $status = array('' => '', '1' => 'Ativo','0' => 'Inativo');

        return view('admin.users.list', compact(['roles','status']));
    }

    /**
     * Informações para datatables
     *
     * @return datatable
     */
    public function datatables()
    {
        //verificando permissão em policy
        $this->authorize('index', User::class);

        //filtros para select
        $filtros = collect();

        // additional users.status search
        if (request()->has('status')) {
            if(!is_null(request('status')))
                $filtros->put('status', request('status'));
        }

        // additional users role search
        if (request()->has('role')) {
            if(!is_null(request('role')))
                $filtros->put('perfil', request('role'));
        }

        //obtendo informações para datatable
        $users = $this->UserRepository->selectDataTable($filtros);

        //instancia datatables
        $datatables =  Datatables::of($users);

        //configurando colunas
        $datatables
            ->addColumn('action', function ($user) {
                $edit = view('partials.components.action', ['action' => 'edit', 'route' => route('admin.users.edit', ['user' => $user->id]), 'ability' => 'admin-users-update', 'class' => 'list-icons-item ' . IconsHelper::getColor('update'), 'classIcon' => IconsHelper::getIcon('update'), 'title' => __('app.actions.labels.edit')])->render();
                $delete = view('partials.components.action', ['action' => 'delete', 'route' => route('admin.users.delete', ['user' => $user->id]), 'ability' => 'admin-users-delete', 'class' => 'btn-removal list-icons-item ' . IconsHelper::getColor('delete'), 'classIcon' => IconsHelper::getIcon('delete'), 'title' => __('app.actions.labels.delete') ])->render();
                $ativar = view('partials.components.action', ['action' => 'activate', 'route' => route('admin.users.activate', ['user' => $user->id]), 'ability' => 'admin-users-activation', 'class' => 'btn-activation list-icons-item ' . IconsHelper::getColor('activate'), 'classIcon' => IconsHelper::getIcon('activate'), 'title' => __('app.actions.labels.activate') ])->render();
                $desativar = view('partials.components.action', ['action' => 'deactivate', 'route' => route('admin.users.deactivate', ['user' => $user->id]), 'ability' => 'admin-users-activation', 'class' => 'btn-deactivation list-icons-item ' . IconsHelper::getColor('deactivate'), 'classIcon' => IconsHelper::getIcon('deactivate'), 'title' => __('app.actions.labels.deactivate') ])->render();
             
                return '<div class="list-icons">' . (($user->status == 1) ? ($desativar . $edit . $delete) : ($ativar . $edit . $delete)) . '</div>';
            })
            ->editColumn('ultimo_login', function($user) {
                return view('partials.components.texts', ['text' => (($user->ultimo_login == null) ? 'Nunca' : date('d/m/Y H:i', strtotime($user->ultimo_login)))])->render();
            })
            ->editColumn('status', function($user){
                return $user->status == 1 ? view('partials.components.icons', ['icon' => 'active'])->render() : view('partials.components.icons', ['icon' => 'inactive'])->render();
            })
            ->addColumn('roles', function($user) {
                $array = array();
                foreach ($user->roles as $role) {
                    $array[] = view('partials.components.badge', ['class' => 'badge badge-primary', 'title' => $role->name ])->render();
                }
                return implode($array, ' ');
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