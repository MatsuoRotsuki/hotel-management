<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('guest_id');
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')
                    ->references('user_id')->on('users')
                    ->onDelete('cascade');
            // $table->string('first_name', 50)->nullable();
            // $table->string('last_name', 50)->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->char('phone', 20);
            $table->string('city', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('identification_number',50)->nullable();
            $table->string('passport_id',50)->nullable();
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
        Schema::dropIfExists('guests');
    }
}
