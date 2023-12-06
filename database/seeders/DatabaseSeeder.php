<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rama',
            'email' => 'demo@demo.com',
            'password' => 'demo',
            'phone_number' => '082131143178',
            'username' => '082131143178',
        ]);
    }
}
