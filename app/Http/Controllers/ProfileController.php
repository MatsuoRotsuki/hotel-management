<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Guest $guest)
    {
        dd($guest);
    }
}
