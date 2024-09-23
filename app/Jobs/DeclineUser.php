<?php

namespace App\Jobs;

use App\Concerns\Enums\Status;
use App\Mail\RegisterDeclined;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DeclineUser implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user) {
        //
    }

    public function handle(): void {
        $this->user->update(['status' => Status::DECLINED->value]);
        Mail::to($this->user['email'])->send(new RegisterDeclined($this->user));
    }
}
