<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Staff::class;

    public function definition()
    {
        return [
            'department_id' => $this->faker->numberBetween($min = 1, $max = 7),
            'dob' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $this->faker->streetAddress(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone' => $this->faker->tollFreePhoneNumber(),
            'identification_number' => $this->faker->ein(),
            'salary' => $this->faker->numberBetween($min = 4000000, $max = 18000000),
        ];
    }
}
