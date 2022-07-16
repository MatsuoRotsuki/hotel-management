<?php

use App\Models\RoomType;
use App\Models\RoomStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('room_id');
            $table->integer('room_number')->unsigned()->unique();
            $table->integer('room_type_id')->unsigned();
            $table->integer('room_status_id')->unsigned()->default(1);

            $table->foreign('room_type_id')->references('room_type_id')->on('room_types')->onDelete('cascade');
            $table->foreign('room_status_id')->references('room_status_id')->on('room_statuses')->onDelete('cascade');

            $table->integer('room_area')->unsigned()->nullable();
            $table->bigInteger('base_price')->unsigned()->default(1000);
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
        Schema::dropIfExists('rooms');
    }
}
