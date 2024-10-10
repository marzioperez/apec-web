<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings {

    public bool $chancellery_api_status;
    public string $abac_file;
    public string $check_out_file;
    public string $ceo_summit_file;

    public static function group(): string {
        return 'general';
    }
}
