<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->nullable(false);
            $table->float('min_point',5,2)->nullable(false);
            $table->float('max_point',5,2)->nullable(false);
            $table->float('min_value',5,2)->nullable(false);
            $table->float('max_value',5,2)->nullable(false);
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
        Schema::dropIfExists('grades');
    }
}
