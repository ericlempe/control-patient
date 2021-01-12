<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{

    /**
     * função para obter collection de User para DataTables
     *
     * @param collection - filtros para select
     * @return collection de User
     */
    public function selectDataTable()
    {
        
        return User::all();
    }

    /**
     * função que salva usuario no banco de dados
     *
     * @param App/Http/Requests/Users/StoreRequest
     * @return bool
     */
    public function store($request)
    {
        //perfil do usuário logado
        $perfil = auth()->user()->getRoles()[0];

        //criando usuário
        $user = User::create($request->all());

        //salvando dados
        if($user){
            //atribuindo perfil
            foreach ($request->input('roles') as $role) {
                $user->assign($role);
            }

            //verificando se existe foto anexada
            if(request()->hasFile('foto')) {
                //movendo foto para pasta de usuarios
                $path = request()->foto->store('users','local-uploads');

                //atualizando registro no bd
                $user->foto = $path;
                $user->save();
            }            

            flash(__('app.actions.messages.created'))->success();
            return true;
        }else{
            $this->notificarSaveError();
            return false;
        }
    }

    /**
     * função que atualiza os dados do usuario no banco de dados
     *
     * @param request com info do form
     * @param int - id do usuario
     * @return bool
     */
    public function update($request, $id)
    {
        //buscando usuario
        $user = $this->find($id);

        //atualizando o objeto
        $user->name = $request->name;
        $user->email = $request->email;
        $user->tel = $request->tel;
        $user->cel = $request->cel;
        $user->sexo = $request->sexo;
        $user->password = ($request->password != null) ? $request->password : '';

        //salvando no bd
        if($user->save()){
            //verificando se existe arquivo anexado
            if(request()->hasFile('foto')) {
                //apagar foto existente
                if(Storage::exists($user->foto)) {
                    //apagando arquivo
                    Storage::delete($user->foto);
                }

                //movendo arquivo para pasta de usuarios
                $path = request()->foto->store('users','local-uploads');

                //atualizando novo caminho da foto no bd
                $user->foto = $path;
                $user->save();
            }

            //tirando perfil atual
            foreach ($user->roles as $role) {
                $user->retract($role);
            }

            //atribuindo novo perfil
            foreach ($request->input('roles') as $role) {
                $user->assign($role);
            }

            //$lead = $user->name . ' teve suas informações atualizadas.';
            //$this->localNotification('warning', $lead, 'Atualizado registro de usuário.', route('admin.users.index'), auth()->user());
            flash(__('app.actions.messages.updated'))->success();
            return true;
        }else{
            $this->notificarSaveError();
            return false;
        }
    }

    /**
     * função que deleta os dados do usuario no banco de dados
     *
     * @param int - id do usuario
     * @param binario - gera notificação ou não
     * @return bool
     */
    public function destroy($id)
    {
        //buscando usuario
        $user = $this->find($id);

        //excluindo no bd
        if(!$user->delete())
            return response()->json(['result' => 'error', 'message' => __('app.actions.messages.failed'), 'style' => 'error'], 403);

        if(Storage::exists($user->foto))
            Storage::delete($user->foto);

        return response()->json(['result' => 'success', 'message' => __('app.actions.messages.deleted'), 'style' => 'success'], 200);
    }
}