<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('progresses')) {
            Schema::create('progresses', function (Blueprint $table) {
                $table->increments('id');
                $table->text('progress');
                $table->enum('is_compelete', array('0','1','2','3'))->default('0');
               $table->integer('plnId')->unsigned()->nullable();
                $table->foreign('plnId')->references('id')->on('plans')->onUpdate('cascade')->onDelete('cascade');

                $table->integer('acId')->unsigned()->nullable();
                $table->foreign('acId')->references('id')->on('activities')->onUpdate('cascade')->onDelete('cascade');


                $table->integer('subId')->unsigned()->nullable();
                $table->foreign('subId')->references('id')->on('subactivities')->onUpdate('cascade')->onDelete('cascade');
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
Schema::dropIfExists('progresses');
    }
}
