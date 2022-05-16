<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'a@a',
            'password' => bcrypt('a'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        User::factory(1000)->create();
    }
}
