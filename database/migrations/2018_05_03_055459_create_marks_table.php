<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('class_id')->unsigned()->index();
            $table->integer('section_id')->unsigned()->index();
            $table->integer('shift_id')->unsigned()->index();
            $table->year('session');
            $table->bigInteger('student_id')->unsigned()->index()->nullable(false);
            $table->integer('exam_term_id')->unsigned()->index();
            $table->integer('subject_id')->unsigned()->index();
            $table->float('written',5,2);
            $table->float('mcq',5,2);
            $table->float('practical',5,2);
            $table->float('class_attendance',5,2);
            $table->float('total_marks', 5, 2);
            $table->integer('grade_id')->unsigned()->index();
            $table->float('point',3,2);
            $table->boolean('absent')->default(false);
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
        Schema::dropIfExists('marks');
    }
}
