<?php

namespace App\Policies;

use App\Models\Speaker;
use App\Models\Admin;

class SpeakerPolicy {
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool {
        return $admin->can('view_any_event::speaker');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Speaker $speaker): bool {
        return $admin->can('view_event::speaker');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool {
        return $admin->can('create_event::speaker');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Speaker $speaker): bool {
        return $admin->can('update_event::speaker');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Speaker $speaker): bool {
        return $admin->can('delete_event::speaker');
    }

}
