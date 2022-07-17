<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->confirmedInformation){
            if ($user->guest->reservations){
                $reservations = $user->guest->reservations;
                return view('payment.index', [
                    'reservations' => $reservations
                ]);
            }
            else {
                return redirect()->route('book.create.render');
            }
        }
        else {
            return redirect()->route('guest.create.render');
        }
    }
}
