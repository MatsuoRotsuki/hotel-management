<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Gallery;
use App\Models\RoomType;
use App\Models\RoomStatus;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $room_statuses = RoomStatus::all();
        $rooms = Room::orderBy('room_number')->get();
        return view('room.index',[
            'rooms' => $rooms,
            'room_statuses' => $room_statuses,
        ]);
    }

    public function filter($filter){
        $rooms = Room::orderBy('room_number')->get()->where('room_status_id', $filter);
        $room_statuses = RoomStatus::all();
        return view('room.index', [
            'rooms' => $rooms,
            'room_statuses' => $room_statuses,
        ]);
    }

    public function show(Room $room)
    {
        return view('room.show',
            ['room' => $room]
        );
    }

    public function redirectCreate()
    {
        $this->authorize('isAdmin', Room::class);

        $room_types = RoomType::all();

        return view('room.create',[
            'room_types' => $room_types,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('isAdmin', Room::class);

        $this->validate($request, [
            'room_number' => ['required', 'unique:rooms', 'numeric'],
            'room_area' => ['numeric'],
            'room_type' => ['required','numeric'],
            'base_price' => ['required','numeric'],
            'img_url' => ['url','nullable'],
        ]);

        Room::create([
            'room_number' => $request->room_number,
            'room_area' => $request->room_area,
            'room_type_id' => $request->room_type,
            'base_price' => $request->base_price,
        ]);

        $room = Room::where('room_number', $request->room_number)->first();
        $room->gallery()->create([
            'img_url' => $request->img_url,
        ]);

        return redirect()->route('room');
    }

    public function redirectUpdate(Room $room)
    {
        $this->authorize('isAdmin', Room::class);

        return view('room.update',
            ['room' => $room]
        );
    }

    public function update(Room $room, Request $request)
    {
        $this->authorize('isAdmin', Room::class);

        $this->validate($request, [
            'room_number' => ['required','numeric'],
            'room_area' => ['numeric'],
            'room_type' => ['required','numeric'],
            'base_price' => ['required','numeric'],
            'room_status' => ['required','numeric'],
            'img_url' => ['url','nullable'],
        ]);

        $room->update([
            'room_number' => $request->room_number,
            'room_area' => $request->room_area,
            'room_type_id' => $request->room_type,
            'base_price' => $request->base_price,
            'room_status_id' => $request->room_status,
        ]);

        if($room->gallery->count()){
            $room->gallery->first()->update(['img_url' => $request->img_url]);
        } else {
            $room->gallery()->create([
                'img_url' => $request->img_url,
            ]);
        }

        return redirect('room');
    }

    public function destroy(Room $room, Request $request)
    {
        $this->authorize('isAdmin', Room::class);

        $room->delete();

        return redirect('room');
    }
}
