<?php

namespace App\Imports;

use App\Jobs\UpdatePassword;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UpdatePasswordUsers implements WithHeadingRow, ToModel {

    public function model(array $row) {
        UpdatePassword::dispatch($row)->onQueue('apec-sqs');
    }
}
