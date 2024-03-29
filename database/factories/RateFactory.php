<?php

namespace Database\Factories;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Rate::class;
    public function definition()
    {
        return [
            'comment' => $this->faker->text($maxNbChars = 200),
            'rating' => $this->faker->numberBetween($min = 1, $max = 5),
        ];
    }
}
