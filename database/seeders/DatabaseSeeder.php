<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        $users = collect();
        $userCount = rand(10, 20);
        for ($i = 0; $i < $userCount; $i++)
        {
            $users->push(User::factory()->create([
                'name' => "name$i",
                'email' => "email$i@szerveroldali.hu",
                'password' => "password$i"
            ]));
        }
    }
}
