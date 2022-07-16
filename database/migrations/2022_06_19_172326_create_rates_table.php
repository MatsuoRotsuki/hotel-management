<?php

use App\Models\User;
use App\Models\Guest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->increments('rate_id');

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')
                ->references('guest_id')->on('guests')
                ->onDelete('cascade');

            $table->text('comment')->nullable();
            $table->smallInteger('rating')->unsigned();
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
        Schema::dropIfExists('rates');
    }
}
