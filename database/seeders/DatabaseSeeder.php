<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Character;
use App\Models\Place;
use App\Models\Contest;

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

        //Users
        $users = collect();
        $userCount = rand(3, 5);
        //Alapból csak 1 adamin van
        $users->push(User::factory()->create([
            'name' => "name0admin",
            'email' => "email0@szerveroldali.hu",
            'password' => "password0",
            'admin' => true
        ]));
        for ($i = 1; $i < $userCount; $i++)
        {
            $users->push(User::factory()->create([
                'name' => "name$i",
                'email' => "email$i@szerveroldali.hu",
                'password' => "password$i"
            ]));
        }

        //Places
        $placeCount = rand(3,5);
        $places = collect();
        for ($i = 0; $i < $placeCount; $i++)
        {
            $places ->push(Place::factory()->create());
        }

        //Characters
        $enemyCount = rand(2,4);
        $characterCount = rand(6,8);
        $characters = collect();
        $startingEnemies = collect();
        $startingHeroes = collect();
        for ($i = 0; $i < $enemyCount; $i++)
        {
            $character = Character::factory()->make();
            $adminUser = User::find(1);
            $character->owner()->associate($adminUser);
            $character->enemy = true;
            $character->save();
            $characters->push($character);
            $startingEnemies->push($character);
        }
        for ($i = 0; $i < $characterCount; $i++)
        {
            $character = Character::factory()->make();
            $notAdminUser = User::find(rand(2,$userCount));
            $character->owner()->associate($notAdminUser);
            $character->save();
            $characters->push($character);
            $startingHeroes->push($character);
        }

        //Contests
        $contestCount = rand(10,20);
        $contests = collect();
        for ($i = 0; $i < $contestCount; $i++)
        {
            $contest = Contest::factory()->make();
            $randHero =$startingHeroes->random();
            $contest->owner()->associate(User::find($randHero->owner_id));
            $contest->place()->associate($places->random());
            $contest->save();
            $fighters = $startingEnemies->random(1);
            $fighters->push($randHero);
            $contest->characters()->attach($fighters->pluck('id'));
            if($contest->win){
                $contest->characters()->updateExistingPivot('1',['enemy_hp' => 0]);
                $contest->characters()->updateExistingPivot('2',['enemy_hp' => 0]);
                $contest->save();
            }else{
                $contest->characters()->updateExistingPivot('1',['hero_hp' => 0]);
                $contest->characters()->updateExistingPivot('2',['hero_hp' => 0]);
                $contest->save();
            }
            $contests->push($contest);
        }

        // foreach ($contest->characters as $character)
        // {
        //     echo $character->pivot->created_at;
        // }

        //Pivot
        // for ($i = 0; $i < $characterCount; $i++)
        // {
        //     $character = Character::find($i);
        //     $character->contests()->attach(1);
        // }

        //            $chosenHero=$startingHeroes[array_rand($startingHeroes,1)];
        //$chosenEnemy=$startingEnemies[array_rand($startingEnemies,1)];


    }
}
