<?php

namespace App\Policies;

use App\Models\AccessAgentToken;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccessAgentTokenPolicy
{
    use HandlesAuthorization;


    public function expireTime(AccessAgentToken $accessAgentToken)
    {
//        return $accessAgentToken->expires_in >= now();
        return ((int)floor(microtime(true) * 1000)) <= ($accessAgentToken->expires_in - 100 * 1000);
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\AccessAgentToken $accessAgentToken
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AccessAgentToken $accessAgentToken)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\AccessAgentToken $accessAgentToken
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AccessAgentToken $accessAgentToken)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\AccessAgentToken $accessAgentToken
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AccessAgentToken $accessAgentToken)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\AccessAgentToken $accessAgentToken
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AccessAgentToken $accessAgentToken)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\AccessAgentToken $accessAgentToken
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AccessAgentToken $accessAgentToken)
    {
        //
    }
}
