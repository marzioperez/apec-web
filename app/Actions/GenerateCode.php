<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class GenerateCode
{
    use AsAction;

    public function handle($names, $last_name) {
        $full_name = $names . ' ' . $last_name;
        preg_match_all("/([A-Z]+)/", $full_name, $words);
        $prefix = implode('', $words[0]);
        return $prefix . strtoupper(fake()->randomLetter()) . date('Y') . fake()->randomDigit() . fake()->randomDigit() . fake()->randomDigit();
    }
}
