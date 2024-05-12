<?php

namespace Database\Seeders;

use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(AdminSeeder::class);
        User::factory()->create([
            'type' => Types::PARTICIPANT->value,
            'status' => Status::CONFIRMED->value,
            'name' => 'Jon',
            'last_name' => 'Doe',
            'email' => 'jondoe@gmail.com',
            'code' => '123456',
            'password' => bcrypt('123456')
        ]);
        User::factory(20)->create();
    }
}
