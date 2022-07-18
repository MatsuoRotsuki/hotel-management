<?php

use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/room-create', [RoomController::class,'redirectCreate'])->name('room-create');
    Route::post('/room-create', [RoomController::class, 'store']);
    Route::get('/room-update/{room}', [RoomController::class, 'redirectUpdate'])->name('room.update');
    Route::post('/room-update/{room}', [RoomController::class, 'update']);
    Route::post('/room-destroy/{room}', [RoomController::class, 'destroy'])->name('room.destroy');
});

Route::get('/info-form',[GuestController::class,'index'])->name('guest.create.render');
Route::post('/info-create',[GuestController::class,'store'])->middleware('auth')->name('guest.create');
Route::get('/guest/{guest}',[ProfileController::class,'index'])->name('profile');

// Route::get('/booked', [ReservationController::class, 'index'])->name('booked')->middleware(['auth','confirmed']);
// Route::post('/book/{room}', [ReservationController::class, 'store'])->name('book.push')->middleware(['auth','confirmed']);
Route::middleware(['auth', 'confirmed'])->group(function () {
    Route::get('/booked', [ReservationController::class, 'index'])->middleware(['didReserved'])->name('booked');//done
    Route::post('/book/{room}', [ReservationController::class, 'store'])->middleware(['didReserved'])->name('book.push');//done
    Route::post('/unbook/{room}', [ReservationController::class, 'destroy'])->middleware(['didReserved'])->name('book.pop');//done
    Route::get('/reservation-create', [ReservationController::class,'redirectCreate'])->name('book.create.render');//done
    Route::post('/reservation-create',[ReservationController::class, 'create'])->name('book.create');//done
    Route::get('/reservation-update/{reservation}', [ReservationController::class, 'redirectUpdate'])->middleware(['didReserved'])->name('book.update.render');
    Route::post('/reservation-update/{reservation}',[ReservationController::class, 'update'])->middleware(['didReserved'])->name('book.update');
    Route::get('/book-confirm', [ReservationController::class, 'confirm'])->middleware(['didReserved'])->name('book.confirm');
    Route::get('/book-confirm/{reservation}/destroy', [ReservationController::class, 'destroyConfirmed'])->middleware(['didReserved'])->name('book.destroy');
});
Route::get('/reservation-control-panel', [ReservationController::class, 'showQueue'])->name('book.showQueue');
Route::get('/confirm/{reservation}', [ReservationController::class, 'makeConfirm'])->name('book.makeConfirm');
Route::get('/decline/{reservation}', [ReservationController::class, 'makeDecline'])->name('book.makeDecline');
Route::get('/checkin/{reservation}', [ReservationController::class, 'makeCheckin'])->name('book.makeCheckin');
Route::get('/checkout/{reservation}', [ReservationController::class, 'makeCheckout'])->name('book.makeCheckout');
Route::get('/delete/{reservation}', [ReservationController::class, 'makeDelete'])->name('book.makeDelete');
Route::get('/book-cancel/{reservation}', [ReservationController::class, 'cancel'])->name('book.cancel');

Route::get('/gallery',[GalleryController::class, 'index'])->name('gallery');

Route::get('/rates', [RatesController::class, 'index'])->name('rates');
Route::post('/rates', [RatesController::class, 'create'])->name('rates.create');
Route::post('/rates/{rate}', [RatesController::class, 'destroy'])->name('rates.destroy');

Route::get('/payments', [PaymentController::class, 'index'])->middleware(['didReserved','confirmed'])->name('payment');

Route::post('/change-role', function(){
    $newRole = (Auth::user()->role === 'admin') ? 'guest' : 'admin';
    Auth::user()->update(['role' => $newRole]);
    return redirect()->route('home');
})->middleware('auth')->name('change.role');

Route::post('/change-role/staff', function(){
    Auth::user()->update(['role' => 'staff']);
    return back();
})->middleware('auth')->name('change.role.staff');

Route::get('/staff/create-form', [StaffController::class, 'create'])->name('staff.create.render');
Route::post('/staff/create',[StaffController::class, 'store'])->name('staff.create');

require __DIR__.'/auth.php';
