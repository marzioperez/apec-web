<?php

namespace Database\Seeders;

use App\Actions\GenerateCode;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Models\Page;
use App\Models\Speaker;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(AdminSeeder::class);
        $this->call(ProgramSeeder::class);
        User::factory()->create([
            'code' => GenerateCode::run('Jon', 'Doe'),
            'type' => Types::PARTICIPANT->value,
            'status' => Status::CONFIRMED->value,
            'name' => 'Jon',
            'last_name' => 'Doe',
            'email' => 'jondoe@gmail.com',
            'phone' => '123456',
            'password' => bcrypt('123456')
        ]);

        Page::create([
            'name' => 'Inicio',
            'slug' => '/',
            'content' => [],
            'is_home' => true
        ]);
        User::factory(20)->create();
        Speaker::factory(24)->create();
    }
}
