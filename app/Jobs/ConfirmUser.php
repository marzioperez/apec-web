<?php

namespace App\Jobs;

use App\Concerns\Enums\Status;
use App\Mail\RegisterSuccess;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ConfirmUser implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user) {
        //
    }

    public function handle(): void {
        $new_password = Str::slug($this->user['phone']);
        $this->user->update([
            'status' => Status::CONFIRMED->value,
            'password' => $new_password
        ]);
        Mail::to($this->user['email'])->send(new RegisterSuccess($this->user, $new_password));
    }
}
