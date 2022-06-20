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
            $table->id();
            $table->integer('room_number')->unique();
            $table->integer('reservation_id')->nullable();
            $table->foreignIdFor(RoomType::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(RoomStatus::class)->default(1)->constrained()->onDelete('cascade');
            $table->integer('room_area')->nullable();
            $table->bigInteger('base_price')->default(1000);
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
