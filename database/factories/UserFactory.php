<?php

namespace Database\Factories;

use App\Actions\GenerateCode;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $name = fake()->firstName();
        $last_name = fake()->firstName();
        $code = GenerateCode::run($name, $last_name);
        $phone = fake()->phoneNumber;

        return [
            'code' => $code,
            'type' => fake()->randomElement([
                Types::PARTICIPANT->value,
                Types::FREE_PASS_PARTICIPANT->value,
                Types::VIP->value
            ]),
            'status' => fake()->randomElement([
                Status::PENDING_APPROVAL->value,
                Status::CONFIRMED->value,
                Status::DECLINED->value,
            ]),
            'current_step' => 1,
            'name' => $name,
            'last_name' => $last_name,
            'business' => fake()->company,
            'economy' => fake()->word,
            'business_description' => fake()->paragraph,
            'role' => fake()->companySuffix,
            'biography' => fake()->paragraph,
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make($phone),
            'phone' => $phone,

            // Información de participante (Opcional)
            'attendee_name' => fake()->name,
            'attendee_email' => fake()->email,
            'send_copy_of_registration' => fake()->boolean,
            'accept_terms_and_conditions' => fake()->boolean
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
