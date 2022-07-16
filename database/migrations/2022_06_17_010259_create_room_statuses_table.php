<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_statuses', function (Blueprint $table) {
            $table->increments('room_status_id');
            $table->text('room_status_name');
        });

        DB::table('room_statuses')->insert([
            ['room_status_id' => 1, 'room_status_name' => 'vacant'],
            ['room_status_id' => 2, 'room_status_name' => 'occupied'],
            ['room_status_id' => 3, 'room_status_name' => 'reserved'],
            ['room_status_id' => 4, 'room_status_name' => 'dirty'],
            ['room_status_id' => 5, 'room_status_name' => 'maintenance'],
            ['room_status_id' => 6, 'room_status_name' => 'out of order'],
            ['room_status_id' => 7, 'room_status_name' => 'cleaning'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_statuses');
    }
}
