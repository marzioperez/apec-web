<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\FequentlyAskedQuestion;
use Illuminate\Auth\Access\HandlesAuthorization;

class FequentlyAskedQuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_c::m::s::fequently::asked::question');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, FequentlyAskedQuestion $fequentlyAskedQuestion): bool
    {
        return $admin->can('view_c::m::s::fequently::asked::question');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_c::m::s::fequently::asked::question');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, FequentlyAskedQuestion $fequentlyAskedQuestion): bool
    {
        return $admin->can('update_c::m::s::fequently::asked::question');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, FequentlyAskedQuestion $fequentlyAskedQuestion): bool
    {
        return $admin->can('delete_c::m::s::fequently::asked::question');
    }

    /**
     * Determine whether the admin can bulk delete.
     */
    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_c::m::s::fequently::asked::question');
    }

    /**
     * Determine whether the admin can permanently delete.
     */
    public function forceDelete(Admin $admin, FequentlyAskedQuestion $fequentlyAskedQuestion): bool
    {
        return $admin->can('{{ ForceDelete }}');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     */
    public function forceDeleteAny(Admin $admin): bool
    {
        return $admin->can('{{ ForceDeleteAny }}');
    }

    /**
     * Determine whether the admin can restore.
     */
    public function restore(Admin $admin, FequentlyAskedQuestion $fequentlyAskedQuestion): bool
    {
        return $admin->can('restore_c::m::s::fequently::asked::question');
    }

    /**
     * Determine whether the admin can bulk restore.
     */
    public function restoreAny(Admin $admin): bool
    {
        return $admin->can('restore_any_c::m::s::fequently::asked::question');
    }

    /**
     * Determine whether the admin can replicate.
     */
    public function replicate(Admin $admin, FequentlyAskedQuestion $fequentlyAskedQuestion): bool
    {
        return $admin->can('replicate_c::m::s::fequently::asked::question');
    }

    /**
     * Determine whether the admin can reorder.
     */
    public function reorder(Admin $admin): bool
    {
        return $admin->can('reorder_c::m::s::fequently::asked::question');
    }
}
