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
            $table->id();
            $table->text('room_type_name');
        });

        DB::table('room_types')->insert([
            ['id' => 1, 'room_type_name' => 'single'],
            ['id' => 2, 'room_type_name' => 'double'],
            ['id' => 3, 'room_type_name' => 'triple'],
            ['id' => 4, 'room_type_name' => 'apartment'],
            ['id' => 5, 'room_type_name' => 'villa'],
            ['id' => 6, 'room_type_name' => 'cottage'],
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
