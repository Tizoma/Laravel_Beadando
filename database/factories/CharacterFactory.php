<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $points=[0,0,0,0];
        $maxpoints=0;
        for ($i = 0; $i < 4; $i++)
        {
            if($i==0){
                $points[0]= rand(0,3);
                $maxpoints+=$points[0];
            }else{
                $points[$i]=rand(0,(20-$maxpoints));
                $maxpoints+=$points[$i];
            }
        }
        return [
            'name' => fake()->name(),
            'defence' => $points[0],
            'strength' => $points[1],
            'accuracy' => $points[2],
            'magic' => $points[3]
        ];
    }
}
