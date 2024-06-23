<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_event::order');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Order $order): bool
    {
        return $admin->can('view_event::order');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_event::order');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Order $order): bool
    {
        return $admin->can('update_event::order');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Order $order): bool
    {
        return $admin->can('delete_event::order');
    }

    /**
     * Determine whether the admin can bulk delete.
     */
    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_event::order');
    }

    /**
     * Determine whether the admin can permanently delete.
     */
    public function forceDelete(Admin $admin, Order $order): bool
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
    public function restore(Admin $admin, Order $order): bool
    {
        return $admin->can('restore_event::order');
    }

    /**
     * Determine whether the admin can bulk restore.
     */
    public function restoreAny(Admin $admin): bool
    {
        return $admin->can('restore_any_event::order');
    }

    /**
     * Determine whether the admin can replicate.
     */
    public function replicate(Admin $admin, Order $order): bool
    {
        return $admin->can('replicate_event::order');
    }

    /**
     * Determine whether the admin can reorder.
     */
    public function reorder(Admin $admin): bool
    {
        return $admin->can('reorder_event::order');
    }
}
