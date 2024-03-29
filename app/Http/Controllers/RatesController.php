<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    public function index()
    {
        $avgRate = Rate::avg('rating');
        $rates = Rate::latest()->get();
        return view('rates.index',[
            'rates' => $rates,
            'avgRate' => $avgRate,
        ]);
    }

    public function create(Request $request)
    {
        $this->authorize('isGuest',Reservation::class);

        $this->validate($request, [
            'rating' => ['required','numeric','max:5'],
            'comment' => ['string','max:255','required'],
        ]);

        $guest = $request->user()->guest;

        if($guest->rates()->count()){
            return back()->withErrors(['alreadyRated' => 'You can only rate once!']);
        }

        if ($guest->reservations()->count()){
            if ($guest->reservations->whereIn('reservation_status_id', [4,5]))
            {
                $guest->rates()->create([
                    'rating' => $request->rating,
                    'comment' => $request->comment,
                ]);
                return back();
            } else return back()->withErrors(['rating' => 'You need to reserve a room of hotel first!']);
        } else {
            return back()->withErrors(['rating' => 'You need to reserve a room of hotel first!']);
        }
    }

    public function destroy(Rate $rate)
    {
        $this->authorize('delete', $rate);

        $rate->delete();

        return back();
    }
}
