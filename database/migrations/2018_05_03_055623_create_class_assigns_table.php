<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_assigns', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('class_id')->unsigned()->index();
            $table->integer('subject_id')->unsigned()->index();
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
        Schema::dropIfExists('class_assigns');
    }
}
