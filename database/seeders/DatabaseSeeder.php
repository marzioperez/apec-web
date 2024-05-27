<?php

namespace Database\Seeders;

use App\Actions\GenerateCode;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Models\CategorySponsor;
use App\Models\Hotel;
use App\Models\Page;
use App\Models\Post;
use App\Models\Speaker;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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

        Storage::disk('web')->put('speaker-default.png', file_get_contents(asset('img/speaker-default.png')));
        Speaker::factory(24)->create();

        Storage::disk('web')->put('logo-default.png', file_get_contents(asset('img/logo-default.png')));
        $platinium = CategorySponsor::create(['name' => 'Platinum']);
        Sponsor::factory(24)->create(['category_sponsor_id' => $platinium->id]);

        $gold = CategorySponsor::create(['name' => 'Gold']);
        Sponsor::factory(16)->create(['category_sponsor_id' => $gold->id]);

        $knowledge_partner = CategorySponsor::create(['name' => 'Knowledge Partner']);
        Sponsor::factory(32)->create(['category_sponsor_id' => $knowledge_partner->id]);

        $media_partners = CategorySponsor::create(['name' => 'Media Partners']);
        Sponsor::factory(8)->create(['category_sponsor_id' => $media_partners->id]);

        Hotel::factory(9)->create();
        Post::factory(20)->create();
    }
}
