<?php

namespace App\Console\Commands;

use App\Concerns\Enums\Types;
use App\Models\User;
use Illuminate\Console\Command;

class ChangeUserTypeName extends Command {

    protected $signature = 'app:change-user-type-name';

    protected $description = 'Command description';

    public function handle() {
        $users = User::where('type', 'Staff pase libre')->get();
        foreach ($users as $user) {
            $user->update([
                'type' => Types::FREE_PASS_STAFF->value
            ]);
        }
    }
}
