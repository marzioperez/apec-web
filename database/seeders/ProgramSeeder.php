<?php

namespace Database\Seeders;

use App\Models\ScheduleCategory;
use App\Models\ScheduleDay;
use App\Models\ScheduleDayActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder {

    public function run(): void {
        $category_1 = ScheduleCategory::create(['name' => 'November 13-14 th 2024']);
        $day_1 = ScheduleDay::create([
            'title' => 'November 13 th',
            'schedule_category_id' => $category_1->id
        ]);

        ScheduleDayActivity::create([
            'title' => 'APEC CEO SUMMIT 2024 WELCOME RECEPTION',
            'content' => fake()->paragraph(),
            'start' => '19:00',
            'end' => '22:00',
            'schedule_day_id' => $day_1->id
        ]);

        $day_2 = ScheduleDay::create([
            'title' => 'November 14 th',
            'schedule_category_id' => $category_1->id
        ]);

        ScheduleDayActivity::create([
            'title' => 'OPENING CEREMONY',
            'content' => fake()->paragraph(),
            'start' => '09:00',
            'end' => '09:30',
            'schedule_day_id' => $day_2->id
        ]);

        ScheduleDayActivity::create([
            'title' => 'SUMMIT FOCUS ON THE STATE OF THE WORLD',
            'content' => fake()->paragraph(),
            'start' => '09:30',
            'end' => '10:15',
            'schedule_day_id' => $day_2->id
        ]);

        ScheduleDayActivity::create([
            'title' => 'SUMMIT KEYNOTE ADDRESS ON GEOPOLITICS',
            'content' => fake()->paragraph(),
            'start' => '10:15',
            'end' => '10:35',
            'schedule_day_id' => $day_2->id
        ]);

        $category_2 = ScheduleCategory::create(['name' => 'November 15 th 2024']);

        $day_3 = ScheduleDay::create([
            'title' => 'November 15 th',
            'schedule_category_id' => $category_2->id
        ]);

        ScheduleDayActivity::create([
            'title' => 'UNPACKING CONSUMER SHIFTS IN DYNAMIC WORLD',
            'content' => fake()->paragraph(),
            'start' => '09:00',
            'end' => '09:20',
            'schedule_day_id' => $day_3->id
        ]);

        ScheduleDayActivity::create([
            'title' => 'SUMMIT FOCUS ON THE FUTURE OF WORK',
            'content' => fake()->paragraph(),
            'start' => '09:20',
            'end' => '10:05',
            'schedule_day_id' => $day_3->id
        ]);

        ScheduleDayActivity::create([
            'title' => 'SUMMIT FOCUS ON HEALTHCARE',
            'content' => fake()->paragraph(),
            'start' => '10:05',
            'end' => '10:55',
            'schedule_day_id' => $day_3->id
        ]);

        ScheduleDayActivity::create([
            'title' => 'LEADER KEYNOTE ADDRESS',
            'content' => fake()->paragraph(),
            'start' => '10:50',
            'end' => '11:10',
            'schedule_day_id' => $day_3->id
        ]);

        ScheduleDayActivity::create([
            'title' => 'NETWORKING BREAK',
            'content' => fake()->paragraph(),
            'start' => '11:10',
            'end' => '11:40',
            'schedule_day_id' => $day_3->id
        ]);
    }
}
