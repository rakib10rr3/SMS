<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeritListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merit_lists', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('session')->unsigned();
            $table->float('total_marks');
            $table->integer('grade_id')->unsigned()->index();
            $table->float('point',3,2);
            $table->integer('class_id')->unsigned()->index();
            $table->integer('section_id')->unsigned()->index();
            $table->integer('shift_id')->unsigned()->index();
            $table->bigInteger('student_id')->unsigned()->index()->nullable(false);
            $table->integer('exam_term_id')->unsigned()->index();
            $table->integer('roll');
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
        Schema::dropIfExists('merit_lists');
    }
}
