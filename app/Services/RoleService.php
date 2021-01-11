<?php 

namespace App\Services;

use Silber\Bouncer\Database\Role;

class RoleService
{
   
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