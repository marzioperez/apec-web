<?php

namespace Database\Factories;

use App\Models\CategorySponsor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'name' => fake()->company,
            'logo' => 'logo-default.png',
            'description' => fake()->paragraph,
            'category_sponsor_id' => 1,
        ];
    }
}
