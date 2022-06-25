<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/room', [RoomController::class, 'index'])->name('room');
Route::get('/room/{room}', [RoomController::class, 'show'])->name('room.show');
Route::get('/room/filter/{filter}', [RoomController::class, 'filter'])->name('room.filter');
// Route::get('/room-create', [RoomController::class,'redirectCreate'])->name('room-create');
// Route::post('/room-create', [RoomController::class, 'store']);
// Route::get('/room-update/{room}', [RoomController::class, 'redirectUpdate'])->name('room.update');
// Route::post('/room-update/{room}', [RoomController::class, 'update']);
// Route::post('/room-destroy/{room}', [RoomController::class, 'destroy'])->name('room.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/room-create', [RoomController::class,'redirectCreate'])->name('room-create');
    Route::post('/room-create', [RoomController::class, 'store']);
    Route::get('/room-update/{room}', [RoomController::class, 'redirectUpdate'])->name('room.update');
    Route::post('/room-update/{room}', [RoomController::class, 'update']);
    Route::post('/room-destroy/{room}', [RoomController::class, 'destroy'])->name('room.destroy');
});

Route::get('/info-form',[GuestController::class,'index'])->name('guest.create.render');
Route::post('/info-create',[GuestController::class,'store'])->middleware('auth')->name('guest.create');
// Route::get('/user',[ProfileController::class,'index'])->name('profile');

Route::get('/booked', [ReservationController::class, 'index'])->name('booked')->middleware(['auth','confirmed']);
Route::post('/book/{room}', [ReservationController::class, 'store'])->name('book.push')->middleware('auth');

Route::get('/gallery', function(){
    dd('Under construction...');
})->name('gallery');

Route::get('/rates', function() {
    dd('rates');
})->name('rates');

Route::post('/change-role', function(){
    $newRole = (Auth::user()->role === 'admin') ? 'guest' : 'admin';
    Auth::user()->update(['role' => $newRole]);
    return back();
})->middleware('auth')->name('change.role');

require __DIR__.'/auth.php';
