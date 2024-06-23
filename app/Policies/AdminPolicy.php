<?php

namespace App\Policies;

use App\Models\Admin;

class AdminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool {
        return $admin->can('view_any_security::admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Admin $admin_user): bool {
        return $admin->can('view_security::admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool {
        return $admin->can('create_security::admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Admin $admin_user): bool {
        return $admin->can('update_security::admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Admin $admin_user): bool {
        return $admin->can('delete_security::admin');
    }
}
