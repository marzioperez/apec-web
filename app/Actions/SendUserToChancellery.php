<?php

namespace App\Actions;

use App\Models\Param;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class SendUserToChancellery {
    use AsAction;

    public function search_param_value($group, $name): void {
        $params = Param::where('group', $group)->get();
        
    }

    public function handle(User $user) {

    }
}
