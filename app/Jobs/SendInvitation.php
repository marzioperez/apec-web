<?php

namespace App\Jobs;

use App\Actions\GenerateCode;
use App\Concerns\Enums\Status;
use App\Mail\RegisterPassFree;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $data) {
    }

    public function handle(): void {
        if ($this->data['email']) {
            $model = User::where('email', $this->data['email'])->first();
            if (!$model) {
                $new_password = Str::slug($this->data['password']);

                $user = new User();
                $user['code'] = GenerateCode::run($this->data['nombres'], $this->data['apellidos']);
                $user['name'] = $this->data['nombres'];
                $user['last_name'] = $this->data['apellidos'];
                $user['business'] = $this->data['empresa'];
                $user['role'] = $this->data['cargo'];
                $user['email'] = $this->data['email'];
                $user['attendee_email'] = $this->data['email_secundario'];
                $user['phone'] = $this->data['telefono'];
                $user['type'] = $this->data['tipo'];
                $user['password'] = $new_password;
                $user['companion_free'] = $this->data['acompanante_free'] === 'Si';
                $user['companion_amount'] = $this->data['monto_acompanante'];
                $user['amount'] = $this->data['monto_participante'];
                $user['staff_free'] = $this->data['staffer_free'] === 'Si';;
                $user['staff_amount'] = $this->data['monto_staffer'];
                $user['status'] = Status::CONFIRMED->value;
                $user->save();

                // Mail::to($this->data['email'])->send(new RegisterPassFree($user, $new_password));
            }
        }
    }
}
