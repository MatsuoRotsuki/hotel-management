<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    public function index()
    {
        $rates = Rate::all();
        return view('rates.index',[
            'rates' => $rates,
        ]);
    }

    public function create(Request $request)
    {
        dd($request);
    }
}
