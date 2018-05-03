<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('code');
            $table->string('name');
            $table->float('full_marks',5,2);
            $table->float('pass_marks',5,2);
            $table->float('written_pass_marks',5,2);
            $table->float('mcq_pass_marks',5,2);
            $table->float('practical_pass_marks',5,2);
            $table->integer('class_id')->unsigned()->index();
            $table->bigInteger('teacher_id')->unsigned()->index();
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
        Schema::dropIfExists('subjects');
    }
}
