<?php

namespace App\Policies;


use App\Models\Admin;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool {
        return $admin->can('view_any_event::user');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, User $model): bool {
        return $admin->can('view_event::user');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool {
        return $admin->can('create_event::user');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, User $model): bool {
        return $admin->can('update_event::user');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, User $model): bool {
        return $admin->can('delete_event::user');
    }

}
