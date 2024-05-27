<?php

namespace App\Imports;

use App\Actions\GenerateCode;
use App\Concerns\Enums\Status;
use App\Mail\RegisterPassFree;
use App\Mail\RegisterSuccess;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Users implements WithHeadingRow, ToModel {

    public function model(array $row) {
        if ($row['email']) {
            $model = User::where('email', $row['email'])->first();
            if (!$model) {
                $user = new User();
                $user['code'] = GenerateCode::run($row['nombres'], $row['apellidos']);
                $user['name'] = $row['nombres'];
                $user['last_name'] = $row['apellidos'];
                $user['business'] = $row['empresa'];
                $user['role'] = $row['cargo'];
                $user['email'] = $row['email'];
                $user['business_email'] = $row['email_secundario'];
                $user['phone'] = $row['telefono'];
                $user['type'] = $row['tipo'];
                $user['password'] = bcrypt($row['telefono']);
                $user['companion_free'] = $row['acompanante_free'] === 'Si';
                $user['companion_amount'] = $row['monto_acompanante'];
                $user['amount'] = $row['monto_participante'];
                $user['staff_free'] = $row['staffer_free'] === 'Si';;
                $user['staff_amount'] = $row['monto_staffer'];
                $user['status'] = Status::CONFIRMED->value;
                $user->save();

                Mail::to($row['email'])->send(new RegisterSuccess($user));
            }
        }
    }
}
