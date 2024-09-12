<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings {

    public bool $chancellery_api_status;
    public string $abac_file;

    public static function group(): string {
        return 'general';
    }
}
