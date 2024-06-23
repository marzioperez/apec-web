<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Order;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool {
        return $admin->can('view_any_event::order');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Order $order): bool {
        return $admin->can('view_event::order');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool {
        return $admin->can('create_event::order');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Order $order): bool {
        return $admin->can('update_event::order');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Order $order): bool {
        return $admin->can('delete_event::order');
    }
}
