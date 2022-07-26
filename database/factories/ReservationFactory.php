<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'checkin_date' => $this->faker->dateTimeBetween('+2 days', '+4 days'),
            'checkout_date' => $this->faker->dateTimeBetween('+5 days', '10 days'),
            'num_of_people' => $this->faker->numberBetween($min = 2, $max = 15),
            'reservation_status_id' => $this->faker->numberBetween($min = 1, $max = 7),
        ];
    }
}
