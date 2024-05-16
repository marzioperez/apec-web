<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Admin::create([
            'name' => "Marzio Perez",
            'email' => "marzioperez@gmail.com",
            'password' => Hash::make("47804233")
        ]);

        Admin::create([
            'name' => "Alexis Sanchez",
            'email' => "sanchezzelaya.casz@gmail.com",
            'password' => Hash::make("123456")
        ]);

        Admin::create([
            'name' => "Eder Novaro",
            'email' => "enovaro@comexperu.org.pe",
            'password' => Hash::make("eder2024")
        ]);
    }
}
