<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAbility
{
    use HandlesAuthorization;

    /**
     * Determine se o usuário pode acessar a tela de exibir usuarios
     *
     * @return bool
     */
    public function index(User $user)
    {

        return Gate::allows('admin-users-index');
    }

    /**
     * Determine se o usuário pode acessar a tela de cadastrar usuarios
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user)
    {

        return Gate::allows('admin-users-create');
    }

    /**
     * Determine se o usuário pode atualizar usuarios
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return bool
     */
    public function update(User $user)
    {

        return Gate::allows('admin-users-update');
    }

    /**
     * Determine se o usuário pode deletar usuarios
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return bool
     */
    public function delete(User $user)
    {

        return Gate::allows('admin-users-delete');
    }
}
