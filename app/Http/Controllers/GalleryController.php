<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $pictures = Gallery::all();
        return view('gallery.index', [
            'pictures' => $pictures,
        ]);
    }
}
