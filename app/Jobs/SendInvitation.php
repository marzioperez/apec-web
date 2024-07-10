<?php

namespace App\Jobs;

use App\Actions\GenerateCode;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
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
                $user['companion_free'] = strtoupper($this->data['acompanante_free']) === 'SI';
                $user['companion_amount'] = $this->data['monto_acompanante'];
                $user['amount'] = $this->data['monto_participante'];
                $user['staff_free'] = strtoupper($this->data['staffer_free']) === 'Si';
                $user['staff_amount'] = $this->data['monto_staffer'];
                $user['status'] = Status::CONFIRMED->value;
                $user->save();

                Mail::to($this->data['email'])->send(new RegisterPassFree($user, $new_password));
                if ($this->data['email_secundario']) {
                    Mail::to($this->data['email_secundario'])->send(new RegisterPassFree($user, $new_password));
                }
            } else {
                $model->update([
                    'companion_free' => strtoupper($this->data['acompanante_free']) === 'SI',
                    'staff_free' => strtoupper($this->data['staffer_free']) === 'SI'
                ]);

                $companion_types = [
                    Types::FREE_PASS_COMPANION->value,
                    Types::COMPANION->value
                ];
                $companion = User::whereIn('type', $companion_types)->where('parent_id', $model['id'])->first();
                if ($companion) {
                    $companion_type = ($model['companion_free'] ? Types::FREE_PASS_COMPANION->value : Types::COMPANION->value);
                    $companion->update(['type' => $companion_type]);
                }

                $staffer_types = [
                    Types::FREE_PASS_STAFF->value,
                    Types::STAFF->value
                ];
                $staffer = User::whereIn('type', $staffer_types)->where('parent_id', $model['id'])->first();
                if ($staffer) {
                    $staff_type = ($model['staff_free'] ? Types::FREE_PASS_STAFF->value : Types::STAFF->value);
                    $staffer->update(['type' => $staff_type]);
                }
            }
        }
    }
}
