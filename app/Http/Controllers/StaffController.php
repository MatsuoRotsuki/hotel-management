<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Staff;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class StaffController extends Controller
{
    public function create()
    {
        $this->authorize('isAdmin', Staff::class);

        $departments = Department::all();

        return view('staff.create', [
            'departments' => $departments,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string'],
            'dob' => ['nullable', 'date'],
            'address' => ['string','nullable'],
            'phone' => ['numeric', 'required'],
            'identification_number' => ['numeric', 'required'],
            'department_id' => ['numeric','min:1','max:3', 'required'],
            'salary' => ['nullable', 'numeric'],
        ]);

        $user = User::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        $user->staff()->create([
            // 'first_name' => $request->firstname,
            // 'last_name' => $request->lastname,
            'department_id' => $request->department_id,
            'dob' => $request->dob,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'identification_number' => $request->identification_number,
            'salary' => $request->salary,
        ]);

        return redirect(RouteServiceProvider::HOME);
    }

    public function destroy(Staff $staff)
    {
        $this->authorize('isAdmin', Staff::class);

        $staff->delete();

        return back();
    }
}
