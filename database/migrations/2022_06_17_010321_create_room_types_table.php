<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->increments('room_type_id');
            $table->text('room_type_name');
        });

        DB::table('room_types')->insert([
            ['room_type_id' => 1, 'room_type_name' => 'single'],
            ['room_type_id' => 2, 'room_type_name' => 'double'],
            ['room_type_id' => 3, 'room_type_name' => 'triple'],
            ['room_type_id' => 4, 'room_type_name' => 'apartment'],
            ['room_type_id' => 5, 'room_type_name' => 'villa'],
            ['room_type_id' => 6, 'room_type_name' => 'cottage'],
            ['room_type_id' => 7, 'room_type_name' => 'japanese-styled'],
            ['room_type_id' => 8, 'room_type_name' => 'western-styled'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_types');
    }
}
