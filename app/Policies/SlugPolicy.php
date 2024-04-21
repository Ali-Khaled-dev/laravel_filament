<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Slug;
use Illuminate\Auth\Access\HandlesAuthorization;

class SlugPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_slug');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Slug  $slug
     * @return bool
     */
    public function view(User $user, Slug $slug): bool
    {
        return $user->can('view_slug');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_slug');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Slug  $slug
     * @return bool
     */
    public function update(User $user, Slug $slug): bool
    {
        return $user->can('update_slug');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Slug  $slug
     * @return bool
     */
    public function delete(User $user, Slug $slug): bool
    {
        return $user->can('delete_slug');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_slug');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Slug  $slug
     * @return bool
     */
    public function forceDelete(User $user, Slug $slug): bool
    {
        return $user->can('force_delete_slug');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_slug');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Slug  $slug
     * @return bool
     */
    public function restore(User $user, Slug $slug): bool
    {
        return $user->can('restore_slug');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_slug');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Slug  $slug
     * @return bool
     */
    public function replicate(User $user, Slug $slug): bool
    {
        return $user->can('replicate_slug');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_slug');
    }

}
