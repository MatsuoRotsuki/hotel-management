<?php

use App\Models\Guest;
use App\Models\ReservationStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('reservation_id');

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')
                ->references('guest_id')->on('guests')
                ->onDelete('cascade');
            // $table->foreignIdFor(Guest::class)->constrained()->onDelete('cascade');
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->integer('num_of_people')->unsigned()->default(1);

            $table->integer('reservation_status_id')->unsigned()->default(1);
            $table->foreign('reservation_status_id')
                ->references('reservation_status_id')->on('reservation_statuses')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
