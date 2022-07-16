<?php

namespace App\Providers;

use App\Models\Rate;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Staff;
use App\Models\Reservation;
use App\Policies\RatePolicy;
use App\Policies\RoomPolicy;
use App\Policies\GuestPolicy;
use App\Policies\StaffPolicy;
use App\Policies\ReservationPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Room::class => RoomPolicy::class,
        Reservation::class => ReservationPolicy::class,
        Staff::class => StaffPolicy::class,
        Rate::class => RatePolicy::class,
        Guest::class => GuestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
