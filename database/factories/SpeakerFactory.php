<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speaker>
 */
class SpeakerFactory extends Factory {
    public function definition(): array {
        return [
            'name' => fake()->name,
            'position' => fake()->companySuffix(),
            'company' => fake()->company,
            'summary' => fake()->paragraph(),
            'biography' => fake()->paragraphs(4, true),
            'photo' => 'speaker-default.png'
        ];
    }
}
