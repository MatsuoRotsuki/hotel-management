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
            $table->id();
            $table->foreignIdFor(Guest::class)->constrained()->onDelete('cascade');
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->integer('num_of_people')->unsigned()->nullable()->default(1);
            $table->foreignIdFor(ReservationStatus::class)->default(1)->constrained()->onDelete('cascade');
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
