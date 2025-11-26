<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MasterBenihFactory extends Factory
{
    public function definition()
    {
        return [
            'jenis_ikan' => $this->faker->word(),
        ];
    }
}
