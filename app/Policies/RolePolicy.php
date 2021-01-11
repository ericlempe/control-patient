<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoleAbility
{
    use HandlesAuthorization;

    /**
     * Determine se o usuário pode acessar a tela de exibir perfis
     *
     * @return bool
     */
    public function index(User $user)
    {

        return Gate::allows('admin-roles-index');
    }

    /**
     * Determine se o usuário pode acessar a tela de cadastrar perfis
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user)
    {

        return Gate::allows('admin-roles-create');
    }

    /**
     * Determine se o usuário pode atualizar perfis
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return bool
     */
    public function update(User $user)
    {

        return Gate::allows('admin-roles-update');
    }

    /**
     * Determine se o usuário pode deletar perfis
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return bool
     */
    public function delete(User $user)
    {

        return Gate::allows('admin-roles-delete');
    }
}
