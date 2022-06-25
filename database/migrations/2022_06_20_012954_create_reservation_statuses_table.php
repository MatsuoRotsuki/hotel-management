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
            $table->id();
            $table->string('reservation_status_name', 50);
        });

        DB::table('reservation_statuses')->insert([
            ['id' => 1, 'reservation_status_name' => 'queue'],
            ['id' => 2, 'reservation_status_name' => 'confirmed'],
            ['id' => 3, 'reservation_status_name' => 'checked in'],
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
