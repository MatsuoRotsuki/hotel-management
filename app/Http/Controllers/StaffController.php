<?php

namespace App\Http\Controllers;


use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;

class StaffController extends Controller
{
    public function create()
    {
        $this->authorize('isAdmin', Staff::class);

        return view('staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $user = User::create([
        //     'firstname' => $request->firstname,
        //     'lastname' => $request->lastname,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'role' => 'guest',
        // ]);

        // return redirect(RouteServiceProvider::HOME);
        dd($request);
    }
}
