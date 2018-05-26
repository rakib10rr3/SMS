<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name',100);
            $table->integer('religion_id')->unsigned()->index();
            $table->integer('blood_group_id')->unsigned()->index();
            $table->integer('gender_id')->unsigned()->index();
            $table->string('nationality',20);
            $table->date('dob');
            $table->string('extra_activity',256)->nullable(true);
            $table->string('photo')->nullable(true);
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('local_guardian_name');
            $table->string('father_cell',11);
            $table->string('mother_cell',11);
            $table->string('local_guardian_cell',11);
            $table->string('current_address',256);
            $table->string('permanent_address',256);
            $table->integer('roll')->unsigned();
            $table->bigInteger('user_id')->unsigned()->index()->nullable(false);
            $table->integer('shift_id')->unsigned()->index();
            $table->year('admission_year');
            $table->year('session');
            $table->integer('the_class_id')->unsigned()->index();
            $table->integer('section_id')->unsigned()->index();
            $table->integer('group_id')->unsigned()->index();
            $table->string('cell',11)->nullable(true);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('students');
    }
}
