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
    public function datatables(RoleService $roleService)
    {
        //verificando permissão em policy
        $this->authorize('index', User::class);

        //obtendo informações para datatable
        $users = $roleService->selectDataTable();

        //instancia datatables
        $datatables =  Datatables::of($users);

        //configurando colunas
        $datatables
            ->addColumn('action', function ($user) {
                // $edit = view('partials.components.action', ['action' => 'edit', 'route' => route('admin.users.edit', ['user' => $user->id]), 'ability' => 'admin-users-update', 'class' => 'list-icons-item ' . IconsHelper::getColor('update'), 'classIcon' => IconsHelper::getIcon('update'), 'title' => __('app.actions.labels.edit')])->render();
                // $delete = view('partials.components.action', ['action' => 'delete', 'route' => route('admin.users.delete', ['user' => $user->id]), 'ability' => 'admin-users-delete', 'class' => 'btn-removal list-icons-item ' . IconsHelper::getColor('delete'), 'classIcon' => IconsHelper::getIcon('delete'), 'title' => __('app.actions.labels.delete') ])->render();
                
             
                return '<div class="list-icons">' . '</div>';
            })
            ->editColumn('ultimo_login', function($user) {
                return 'nada';
                // return view('partials.components.texts', ['text' => (($user->ultimo_login == null) ? 'Nunca' : date('d/m/Y H:i', strtotime($user->ultimo_login)))])->render();
            })
            ->editColumn('status', function($user){
                return '';
                // return $user->status == 1 ? view('partials.components.icons', ['icon' => 'active'])->render() : view('partials.components.icons', ['icon' => 'inactive'])->render();
            })
            ->addColumn('roles', function($user) {
                return 'perfis';
                // $array = array();
                // foreach ($user->roles as $role) {
                //     $array[] = view('partials.components.badge', ['class' => 'badge badge-primary', 'title' => $role->name ])->render();
                // }
                // return implode($array, ' ');
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
