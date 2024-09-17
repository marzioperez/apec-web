<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePassword implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public $data) {
    }

    public function handle(): void {
        if ($this->data['email']) {
            $model = User::where('email', $this->data['email'])->first();
            if ($model) {
                $model->password = $this->data['password'];
                $model->save();
            }
        }
    }
}
