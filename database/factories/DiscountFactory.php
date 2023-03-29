<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid;

class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => Uuid\Uuid::getFactory()->uuid1(),
            'value' => random_int(1,50),
            'user_id' => User::all()->random()->id,
            'created_at' => $this->faker->dateTimeBetween('-10day'),
        ];
    }
}
