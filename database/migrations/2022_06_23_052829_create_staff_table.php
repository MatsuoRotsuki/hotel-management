<?php

use App\Models\Department;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id('staff_id');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->foreignIdFor(Department::class)->constrained()->onDelete('cascade');
            $table->date('dob')->nullable();
            $table->string('address',50)->nullable();
            $table->char('gender', 6);
            $table->char('phone', 10);
            $table->string('identification_number', 50);
            $table->bigInteger('salary')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
