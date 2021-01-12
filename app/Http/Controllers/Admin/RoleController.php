<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
