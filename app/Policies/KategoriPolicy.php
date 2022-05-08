<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategoriPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
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
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Kategori $kategori)
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
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Kategori $kategori)
    {
        if ($user->checkRole('user') && $user->id === $kategori->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Kategori $kategori)
    {
        if ($user->checkRole('user') && $user->id === $kategori->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Kategori $kategori)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Kategori $kategori)
    {
        //
    }
}
