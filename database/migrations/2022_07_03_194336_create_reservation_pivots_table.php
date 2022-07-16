<?php

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationPivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_room', function (Blueprint $table) {
            // $table->foreignIdFor(Room::class)->constrained()->onDelete('cascade');
            // $table->foreignIdFor(Reservation::class)->constrained()->onDelete('cascade');
            $table->integer('room_id')->unsigned();
            $table->integer('reservation_id')->unsigned();

            $table->foreign('room_id')
                ->references('room_id')->on('rooms')
                ->onDelete('cascade');
            $table->foreign('reservation_id')
                ->references('reservation_id')->on('reservations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_room');
    }
}
