<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->role !== 'admin'){
            $this->authorize('isGuest', Room::class);
        }

        return view('guest.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $this->validate($request,[
            'dob' => ['date'],
            'address' => ['string','max:50','nullable'],
            'phone' => ['required','string','max:50','min:10'],
            'city' => ['string','max:50','nullable'],
            'country' => ['string','max:50','nullable'],
            'passport' => ['string','max:50','nullable'],
            'cccd' => ['string','max:50','nullable'],
        ]);

        $user->update(['confirmedInformation' => 1]);

        $request->user()->guest()->create([
            'first_name' => $user->firstname,
            'last_name' => $user->lastname,
            'dob' => $request->dob,
            'address' => $request->address,
            'phone' => $request->phone,
            'city' => $request->city,
            'country' => $request->country,
            'passport_id' => $request->passport,
            'identification_number' => $request->cccd,
        ]);

        return redirect()->route('room');
    }

    // public function show(User $user, Guest $guest)
    // {
    //     return view('guest.profile', [
    //         'user' => $user,
    //         'guest' => $guest,
    //     ]);
    // }
}
