<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => env('DEFAULT_USER_NAME','Test User'),
            'email' => env('DEFAULT_USER_EMAIL', 'test@example.com'),
            'password' => env('DEFAULT_USER_PASSWORD', bcrypt('password'))
        ]);
    }
}
