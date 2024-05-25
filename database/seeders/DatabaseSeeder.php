<?php

namespace Database\Seeders;

use App\Actions\GenerateCode;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Models\CategorySponsor;
use App\Models\Page;
use App\Models\Speaker;
use App\Models\Sponsor;
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
        User::factory(20)->create();

        Page::create([
            'name' => 'Inicio',
            'slug' => '/',
            'content' => [],
            'is_home' => true
        ]);

        Speaker::factory(24)->create();

        $platinium = CategorySponsor::create(['name' => 'Platinum']);
        Sponsor::factory(24)->create(['category_sponsor_id' => $platinium->id]);

        $gold = CategorySponsor::create(['name' => 'Gold']);
        Sponsor::factory(16)->create(['category_sponsor_id' => $gold->id]);

        $knowledge_partner = CategorySponsor::create(['name' => 'Knowledge Partner']);
        Sponsor::factory(32)->create(['category_sponsor_id' => $knowledge_partner->id]);

        $media_partners = CategorySponsor::create(['name' => 'Media Partners']);
        Sponsor::factory(8)->create(['category_sponsor_id' => $media_partners->id]);
    }
}
