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
            $table->id();
            $table->text('room_status_name');
        });

        DB::table('room_statuses')->insert([
            ['id' => 1, 'room_status_name' => 'vacant'],
            ['id' => 2, 'room_status_name' => 'occupied'],
            ['id' => 3, 'room_status_name' => 'reserved'],
            ['id' => 4, 'room_status_name' => 'dirty'],
            ['id' => 5, 'room_status_name' => 'maintenance'],
            ['id' => 6, 'room_status_name' => 'out of order'],
            ['id' => 7, 'room_status_name' => 'cleaning'],
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
