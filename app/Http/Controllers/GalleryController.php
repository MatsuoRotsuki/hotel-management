<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->user()->guest->reservations->where('reservation_status_id', 1)->count());
        dd($request->user()->guest->alreadyReserve());
    }
}
