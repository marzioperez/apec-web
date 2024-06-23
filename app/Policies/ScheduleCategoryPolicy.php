<?php

namespace App\Policies;

use App\Models\ScheduleCategory;
use App\Models\Admin;

class ScheduleCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool {
        return $admin->can('view_any_event::schedule::category');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, ScheduleCategory $scheduleCategory): bool {
        return $admin->can('view_event::schedule::category');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool {
        return $admin->can('create_event::schedule::category');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, ScheduleCategory $scheduleCategory): bool {
        return $admin->can('update_event::schedule::category');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, ScheduleCategory $scheduleCategory): bool {
        return $admin->can('delete_event::schedule::category');
    }
}
