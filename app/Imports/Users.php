<?php

namespace App\Imports;

use App\Jobs\SendInvitation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Users implements WithHeadingRow, ToModel {

    public function model(array $row) {
        SendInvitation::dispatch($row)->onQueue('apec-sqs');
    }
}
