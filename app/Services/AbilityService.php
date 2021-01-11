<?php 

namespace App\Services;

use Silber\Bouncer\Database\Ability;

class AbilityRepository extends BaseRepository 
{

    /**
     * função que gera query para DataTables
     *
     * @return collection of abilities
     */
    public function selectDataTable()
    {

        return Ability::select('id','name','title','created_at')->get();
    }

    /**
     * função que busca objeto da Ability pelo id
     *
     * @param int - id da Ability buscada
     * @return objeto Ability
     */
    public function find($id)
    {

        return Ability::findOrFail($id);
    }

    /**
     * função que obtém lista de permissões para select
     *
     * @return collection de abilities
     */
    public function listar()
    {
        //obtendo perfil do usuário
        $perfil = auth()->user()->getRoles()->toArray();

        //obtendo permissoes de acordo com perfil
        // if(in_array('superadmin', $perfil))
        //     return Ability::get()->pluck('title', 'name');

        return Ability::where('name', 'not like', '%Permissoes')->get()->pluck('title', 'name');
    }

    /**
     * função que salva permissão no banco de dados
     *
     * @param request com info do form
     * @return bool
     */
    public function store($request)
    {
        //obtendo dados
        $ability = new Ability;
        $ability->name = $request->nome;
        $ability->title = $request->titulo;

        //salvando dados
        if($ability->save()){
            // flash(__('app.actions.messages.created'))->success();
            return true;
        }else{
            $this->notificarSaveError();
            return false;
        }
    }

    /**
     * função que atualiza os dados da permissão no banco de dados
     *
     * @param request com info do form
     * @param int - id da permissão
     * @return bool
     */
    public function update($request, $id)
    {
        //buscando usuario
        $ability = $this->find($id);

        //atualizando o objeto
        $ability->name = $request->nome;
        $ability->title = $request->titulo;

        //salvando no bd
        if($ability->save()){
            // flash(__('app.actions.messages.updated'))->success();
            return true;
        }else{
            $this->notificarSaveError();
            return false;
        }
    }

    /**
     * função que deleta os dados da permissão no banco de dados
     *
     * @param int - id da permissão
     * @return bool
     */
    public function destroy($id)
    {
        //buscando usuario
        $ability = $this->find($id);

        //excluindo no bd
        if($ability->delete())
            return response()->json(['result' => 'success', 'message' => __('app.actions.messages.deleted'), 'style' => 'success'], 200);

        return response()->json(['result' => 'error', 'message' => __('app.actions.messages.failed'), 'style' => 'error'], 403);
    }
}