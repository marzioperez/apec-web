<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQrCode {

    use AsAction;

    public function handle($code) {
        $from = [117, 180, 46];
        $to = [0, 150, 0];
        $file_name = md5($code) . ".png";
        QrCode::size(250)
            ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
            ->margin(1)
            ->format('png')
            ->generate($code, "../storage/app/public/qrs/{$file_name}");
        return $file_name;
    }
}
