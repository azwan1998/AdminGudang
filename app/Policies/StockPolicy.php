<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Stock;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if ($user->checkRole('user')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Stock $stock)
    {
        if ($user->checkRole('user')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->checkRole('user')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Stock $stock)
    {
        if ($user->checkRole('user') && $user->id === $stock->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Stock $stock)
    {
        if ($user->checkRole('user') && $user->id === $stock->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Stock $stock)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Stock $stock)
    {
        //
    }
}
