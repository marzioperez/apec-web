<?php

namespace App\Policies;

use App\Models\Hotel;
use App\Models\Admin;

class HotelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool {
        return $admin->can('view_any_event::hotel');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Hotel $hotel): bool {
        return $admin->can('view_event::hotel');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool {
        return $admin->can('create_event::hotel');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Hotel $hotel): bool {
        return $admin->can('update_event::hotel');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Hotel $hotel): bool {
        return $admin->can('delete_event::hotel');
    }

}
