<?php 

namespace App\Services;

use Silber\Bouncer\Database\Role;

class RoleService
{
    /**
     * função que gera query para DataTables
     *
     * @return collection of roles
     */
    public function selectDataTable()
    {
        //obtendo perfil do usuário
        // $perfil = auth()->user()->getRoles()->toArray();

        // if(in_array('superadmin', $perfil))
        //     return Role::select('id','name','title','created_at')->with('abilities')->get();

        return Role::select('id','name','title','created_at')->with('abilities')->where('level', 0)->get();
    }

    /**
     * função que busca objeto do perfil pelo id
     *
     * @param int - id do perfil buscado
     * @return objeto role 
     */
    public function find($id)
    {
        return Role::findOrFail($id);
    }

    /**
     * função que gera lista de perfis para select
     * 
     * @return collection de roles
     */
    public function listar()
    {
        //obtendo perfil do usuário
        $perfil = auth()->user()->getRoles()->toArray();

        // //obtendo perfis de acordo com perfil
        // if(in_array('superadmin', $perfil))
        //     return Role::orderBy('title','asc')->get()->pluck('title', 'name');

        return Role::orderBy('title','asc')->where('level', 0)->get()->pluck('title', 'name');
    }

    /**
     * função que salva perfil no banco de dados
     *
     * @param request com info do form
     * @return bool
     */
    public function store($request)
    {
        //obtendo dados
        $role = new Role;
        $role->title = $request->title;
        $role->name = $request->nome;

        //salvando dados
        if($role->save()){
            //atribuindo permissoes
            $role->allow($request->input('abilities'));

            // flash(__('app.actions.messages.created'))->success();
            return true;
        }else{
            $this->notificarSaveError();
            return false;
        }
    }

    /**
     * função que atualiza os dados do perfil no banco de dados
     *
     * @param request com info do form
     * @param int - id do perfil
     * @return bool
     */
    public function update($request, $id)
    {
        //buscando usuario
        $role = $this->find($id);

        //atualizando o objeto caso modificado
        if ($request->nome != $role->title) {
            $role->title = $request->title;
            $role->name = $request->name;
        }

        //salvando no bd
        if($role->save()){
            //atualizando permissoes
            foreach ($role->getAbilities() as $ability) {
                $role->disallow($ability->name);
            }
            $role->allow($request->input('abilities'));

            // flash(__('app.actions.messages.updated'))->success();
            return true;
        }else{
            $this->notificarSaveError();
            return false;
        }
    }

    /**
     * função que deleta os dados do perfil no banco de dados
     *
     * @param int - id do perfil
     * @return bool
     */
    public function destroy($id)
    {
        //buscando usuario
        $role = $this->find($id);

        //removendo permissoes
        foreach ($role->getAbilities() as $ability) {
            $role->disallow($ability->name);
        }

         //excluindo no bd
        if($role->delete())
            return response()->json(['result' => 'success', 'message' => __('app.actions.messages.deleted'), 'style' => 'success'], 200);

        return response()->json(['result' => 'error', 'message' => __('app.actions.messages.failed'), 'style' => 'error'], 403);
    }
}