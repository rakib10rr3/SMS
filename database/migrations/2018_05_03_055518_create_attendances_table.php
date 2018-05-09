<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->date('date');
            $table->bigInteger('student_id')->unsigned()->index()->nullable(false);
            $table->integer('the_class_id')->unsigned()->index();
            $table->integer('subject_id')->unsigned()->index();
            $table->integer('section_id')->unsigned()->index();
            $table->integer('shift_id')->unsigned()->index();
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
        Schema::dropIfExists('attendances');
    }
}
