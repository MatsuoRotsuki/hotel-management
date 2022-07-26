<?php

namespace Database\Seeders;

use App\Models\Rate;
use App\Models\Room;
use App\Models\User;
use App\Models\Guest;
use App\Models\Staff;
use App\Models\Gallery;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $rooms = Room::factory()->times(700)->create()->each(function($room){
            Gallery::factory(rand(0,1))->create([
                'room_id' => $room->room_id
            ]);
        });
        User::factory()->times(1000)->create()->each(function($user) use($rooms) {
            if($user->confirmed_information){
                Guest::factory(1)->create([
                    'user_id' => $user->user_id
                ])->each(function($guest) use($rooms) {

                    Reservation::factory(rand(0,3))->create([
                        'guest_id' => $guest->guest_id
                    ])->each(function($reservation) use($rooms) {
                        $reservation->rooms()->attach($rooms->random(rand(1,4)));
                    });
                });
            }
        });
        Guest::all()->each(function($guest) {
            if($guest->reservations->whereIn('reservation_status_id', [4, 5])->count()){
                Rate::factory(1)->create([
                    'guest_id' => $guest->guest_id
                ]);
            }
        });
        User::factory(30)->create()->each(function($user){
            Staff::factory(1)->create([
                'user_id' => $user->user_id
            ]);
        });
    }
}
