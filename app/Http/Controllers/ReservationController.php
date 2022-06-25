<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation.index');
    }

    public function store(Room $room, Request $request){ //book.push
        dd('book this room');
    }

    public function showQueue(){
        $this->authorize('isStaff', Reservation::class);

        dd('ok this is confirmed book');
    }

    public function destroy(){
        dd('is ok to delete');
    }
}
