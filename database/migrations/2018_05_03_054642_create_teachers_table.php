<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name',100);
            $table->string('current_address',256);
            $table->string('permanent_address',256);
            $table->date('dob');
            $table->string('national_id',100);
            $table->boolean('marital_status');
            $table->bigInteger('user_id')->unsigned()->index()->nullable(false);
            $table->integer('religion_id')->unsigned()->index();
            $table->integer('blood_group_id')->unsigned()->index();
            $table->integer('gender_id')->unsigned()->index();
            $table->string('nationality',20);
            $table->string('cell',20);
            $table->string('photo',20);
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
        Schema::dropIfExists('teachers');
    }
}
