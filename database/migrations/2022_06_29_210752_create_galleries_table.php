<?php

use App\Models\Room;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('gallery_id');
            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')
                ->references('room_id')->on('rooms')
                ->onDelete('cascade');
            // $table->foreignIdFor(Room::class)->constrained()->onDelete('cascade');
            $table->text('img_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleries');
    }
}
