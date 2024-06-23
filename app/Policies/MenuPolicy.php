<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\Admin;

class MenuPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool {
        return $admin->can('view_any_c::m::s::menu');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Menu $menu): bool {
        return $admin->can('view_c::m::s::menu');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool {
        return $admin->can('create_c::m::s::menu');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Menu $menu): bool {
        return $admin->can('update_c::m::s::menu');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Menu $menu): bool {
        return $admin->can('delete_c::m::s::menu');
    }
}
