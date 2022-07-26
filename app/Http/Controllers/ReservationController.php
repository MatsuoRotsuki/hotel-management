<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Guest;
use App\Models\RoomStatus;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $guest = $request->user()->guest;

        $reservation = $guest->reservations->whereIn('reservation_status_id', [1, 2, 3, 4])->first();

        $reservation_status = $reservation->reservation_status_id;

        $selectedRoomIds = null;
        $confirmedRoomIds = null;
        $queueRoomIds = null;
        $checkedInRoomIds = null;
        $checkedOutRoomsIds = null;

        if ($reservation_status === 1){
            $selectedRoomIds = $reservation->rooms()->pluck('rooms.room_id');
        } elseif ($reservation_status === 2){
            $queueRoomIds = $reservation->rooms()->pluck('rooms.room_id');
        } elseif ($reservation_status === 3){
            $confirmedRoomIds = $reservation->rooms()->pluck('rooms.room_id');
        } elseif ($reservation_status === 4){
            $checkedInRoomIds = $reservation->rooms()->pluck('rooms.room_id');
        }

        $totalMoney = $reservation->totalMoney();
        $days = $reservation->days();

        $selectedRooms = Room::find($selectedRoomIds);
        $confirmedRooms = Room::find($confirmedRoomIds);
        $queueRooms = Room::find($queueRoomIds);
        $checkedInRooms = Room::find($checkedInRoomIds);
        $checkedOutRooms = Room::find($checkedOutRoomsIds);

        return view('reservation.index', [
            'selectedRooms' => $selectedRooms,
            'queueRooms' => $queueRooms,
            'confirmedRooms' => $confirmedRooms,
            'checkedInRooms' => $checkedInRooms,
            'checkedOutRooms' => $checkedOutRooms,
            'totalMoney' => $totalMoney,
            'days' => $days,
            'reservation' => $reservation,
        ]);
    }

    public function store(Room $room, Request $request){ //book.push
        $this->authorize('book', $room);

        $reservation = $request->user()->guest->reservations->whereIn('reservation_status_id', [1])->first();
        $roomId = $room->room_id;
        $reservation->rooms()->attach($roomId);
        return back();
    }

    public function create(Request $request){

        $this->authorize('isGuest', Reservation::class);

        $this->authorize('create', Reservation::class);

        $this->validate($request, [
            'checkin_date' => ['required','date','after:yesterday'],
            'checkout_date' => ['required','date','after:checkin_date'],
            'num_of_people' => ['required','numeric','max:50'],
        ]);

        $request->user()->guest->reservations()->create([
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'num_of_people' => $request->num_of_people
        ]);

        return redirect()->route('room');
    }

    public function redirectUpdate(Reservation $reservation){
        $this->authorize('update', $reservation);
        return view('reservation.update', [
            'reservation' => $reservation
        ]);
    }

    public function update(Request $request, Reservation $reservation){
        $this->authorize('update', $reservation);

        $this->validate($request, [
            'checkin_date' => ['required','date','after:yesterday'],
            'checkout_date' => ['required','date','after:checkin_date'],
            'num_of_people' => ['required','numeric','max:50'],
        ]);

        $reservation->update([
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'num_of_people' => $request->num_of_people
        ]);

        if ($reservation->reservation_status_id === 3){
            $reservation->update(['reservation_status_id' => 2]);
        }

        return redirect()->route('booked');
    }

    public function redirectCreate(){
        $this->authorize('isGuest', Reservation::class);
        $this->authorize('create', Reservation::class);

        return view('reservation.create');
    }

    public function showQueue(Request $request){
        $this->authorize('isStaff', Reservation::class);

        $reservations = Reservation::whereIn('reservation_status_id', [1, 2, 3, 4, 5, 6, 7])->get()->sortBy('reservation_id');

        return view('reservation.control', [
            'reservations' => $reservations,
        ]);
    }

    public function makeConfirm(Reservation $reservation){
        $this->authorize('isStaff', Reservation::class);

        $newStatus = $reservation->reservation_status_id + 1;

        $reservation->update(['reservation_status_id' => $newStatus]);

        return back();
    }

    public function confirm(Request $request)
    {
        $this->authorize('isGuest', Reservation::class);
        $guest = $request->user()->guest;
        $reservation = $guest->reservations->whereIn('reservation_status_id', [1])->first();
        $room_ids = $reservation->rooms()->pluck('rooms.room_id');
        $guestReserveId = $reservation->reservation_id;
        $reservation->update(['reservation_status_id' => 2]);
        $idNotIn = Reservation::all()->except($guestReserveId)->pluck('reservation_id');


        $rooms = Room::find($room_ids);
        foreach ($rooms as $room){
            $room->update(['room_status_id' => 3]);
            $room->reservations()->detach($idNotIn);
        }
        return redirect()->route('booked');
    }

    public function destroy(Room $room, Request $request){
        $this->authorize('unbook', $room);

        $reservation = $request->user()->guest->reservations->whereIn('reservation_status_id', [1])->first();
        $roomId = $room->room_id;
        $reservation->rooms()->detach($roomId);
        return back();
    }

    public function destroyConfirmed(Reservation $reservation){

        $this->authorize('update', $reservation);

        $reservation->update(['reservation_status_id' => 1]);

        $roomId = $reservation->rooms()->pluck('rooms.room_id');
        $rooms = Room::find($roomId);
        foreach ($rooms as $room) {
            $room->update(['room_status_id' => 1]);
        }
        return redirect()->route('booked');
    }

    public function cancel(Request $request, Reservation $reservation){
        $this->authorize('isAuth', Reservation::class);

        $reservation->update(['reservation_status_id' => 6]);

        $roomId = $reservation->rooms()->pluck('rooms.room_id');
        $rooms = Room::find($roomId);
        foreach ($rooms as $room) {
            $room->update(['room_status_id' => 1]);
        }

        return back();
    }

    public function makeDecline(Reservation $reservation)
    {
        $this->authorize('isStaff', Reservation::class);

        $reservation->update(['reservation_status_id' => 7]);

        $roomId = $reservation->rooms()->pluck('rooms.room_id');
        $rooms = Room::find($roomId);
        foreach ($rooms as $room) {
            $room->update(['room_status_id' => 1]);
        }

        return back();
    }

    public function makeCheckin(Reservation $reservation){
        $this->authorize('isStaff', Reservation::class);

        $reservation->update(['reservation_status_id' => 4]);

        $roomId = $reservation->rooms()->pluck('rooms.room_id');
        $rooms = Room::find($roomId);
        foreach ($rooms as $room) {
            $room->update(['room_status_id' => 2]);
        }

        return back();
    }

    public function makeCheckout(Reservation $reservation)
    {
        $this->authorize('checkout', $reservation);

        $reservation->update(['reservation_status_id' => 5]);

        $roomId = $reservation->rooms()->pluck('rooms.room_id');
        $rooms = Room::find($roomId);
        foreach ($rooms as $room) {
            $room->update(['room_status_id' => 4]);
        }

        return back();
    }

    public function makeDelete(Reservation $reservation)
    {
        $this->authorize('isStaff', Reservation::class);

        $reservation->delete();

        return back();
    }
}
