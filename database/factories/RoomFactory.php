<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Room::class;

    public function definition()
    {
        return [
            'room_number' => $this->faker->unique()->numberBetween($min = 100, $max = 1000),
            'room_type_id' => $this->faker->numberBetween($min = 1, $max = 8),
            'room_status_id' => $this->faker->numberBetween($min = 1, $max = 7),
            'room_area' => $this->faker->numberBetween($min = 12, $max = 50),
            'base_price' => $this->faker->numberBetween($min = 20000, $max = 120000),
        ];
    }
}
