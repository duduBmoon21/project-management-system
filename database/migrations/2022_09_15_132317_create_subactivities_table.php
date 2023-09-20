<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubactivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('subactivities')) {
        Schema::create('subactivities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('start_date');
            $table->string('end_date');
            $table->text('description');


            $table->integer('activ_id')->unsigned();
            $table->integer('empl_id')->unsigned();
            $table->foreign('activ_id')->references('id')->on('activities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('empl_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subactivities');
    }
}
