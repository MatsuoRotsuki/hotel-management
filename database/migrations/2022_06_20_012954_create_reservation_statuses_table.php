<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_statuses', function (Blueprint $table) {
            $table->increments('reservation_status_id');
            $table->string('reservation_status_name', 50);
        });

        DB::table('reservation_statuses')->insert([
            ['reservation_status_id' => 1, 'reservation_status_name' => 'choose'],
            ['reservation_status_id' => 2, 'reservation_status_name' => 'queue'],
            ['reservation_status_id' => 3, 'reservation_status_name' => 'confirmed'],
            ['reservation_status_id' => 4, 'reservation_status_name' => 'checked in'],
            ['reservation_status_id' => 5, 'reservation_status_name' => 'checked out'],
            ['reservation_status_id' => 6, 'reservation_status_name' => 'cancelled'],
            ['reservation_status_id' => 7, 'reservation_status_name' => 'declined'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_statuses');
    }
}
