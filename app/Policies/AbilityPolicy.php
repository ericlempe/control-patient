<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbilityPolicy
{
    use HandlesAuthorization;

      /**
     * Determine se o usuário pode acessar a tela de exibir habilidades
     *
     * @return bool
     */
    public function index(User $user)
    {

        return Gate::allows('admin-abilities-index');
    }

    /**
     * Determine se o usuário pode acessar a tela de cadastrar habilidades
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user)
    {

        return Gate::allows('admin-abilities-create');
    }

    /**
     * Determine se o usuário pode atualizar habilidades
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return bool
     */
    public function update(User $user)
    {

        return Gate::allows('admin-abilities-update');
    }

    /**
     * Determine se o usuário pode deletar habilidades
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return bool
     */
    public function delete(User $user)
    {

        return Gate::allows('admin-abilities-delete');
    }
}
