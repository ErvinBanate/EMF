<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->realText(15),
            'img_url' => $this->faker->image,
        ];
    }
}
