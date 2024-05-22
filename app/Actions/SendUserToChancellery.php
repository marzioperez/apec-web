<?php

namespace App\Actions;

use App\Models\Param;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class SendUserToChancellery {
    use AsAction;

    public function search_param_value($group, $name): mixed {
        $params = Param::where('group', $group)->get();
        foreach ($params as $param) {
            if ($param->name === $name) {
                return $param['value'];
            }
        }
        return null;
    }

    public function handle(User $user) {

    }
}
