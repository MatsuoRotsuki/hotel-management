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
            $table->id('guest_id');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('dob');
            $table->string('address',50);
            $table->char('phone', 10);
            $table->string('city', 50);
            $table->string('country', 50);
            $table->bigInteger('identification_number')->nullable();
            $table->bigInteger('passport_id')->nullable();
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
