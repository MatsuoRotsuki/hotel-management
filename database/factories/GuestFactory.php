<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Guest::class;

    public function definition()
    {
        return [
            'dob' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $this->faker->streetAddress(),
            'phone' => $this->faker->tollFreePhoneNumber(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'identification_number' => $this->faker->ein(),
            'passport_id' => $this->faker->ein(),
        ];
    }
}
