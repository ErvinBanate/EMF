<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListOfExecutivesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'position' => $this->faker->realText(15),
        ];
    }
}
