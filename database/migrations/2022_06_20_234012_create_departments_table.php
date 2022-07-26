<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('department_id');
            $table->string('department_name');
            $table->text('note')->nullable();
        });

        DB::table('departments')->insert([
            ['department_id' => 1, 'department_name' => 'Reception'],
            ['department_id' => 2, 'department_name' => 'Housekeeping'],
            ['department_id' => 3, 'department_name' => 'Engineering and Maintenance'],
            ['department_id' => 4, 'department_name' => 'Account and Credits'],
            ['department_id' => 5, 'department_name' => 'Security'],
            ['department_id' => 6, 'department_name' => 'HR'],
            ['department_id' => 7, 'department_name' => 'Marketing'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
