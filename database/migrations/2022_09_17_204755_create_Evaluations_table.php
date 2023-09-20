<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

   
    public function up()
    {
        if(! Schema::hasTable('Evaluations')) {
            Schema::create('Evaluations', function (Blueprint $table) {
                $table->increments('id');
                $table-> integer('acts_id')->unsigned()->nullable();
                $table->foreign('acts_id')->references('id')->on('activities')->onUpdate('cascade')->onDelete('cascade');
                $table-> integer('subst_id')->unsigned()->nullable();
                $table->foreign('subst_id')->references('id')->on('subactivities')->onUpdate('cascade')->onDelete('cascade');
                $table->integer('plans_id')->unsigned()->nullable();
                $table->foreign('plans_id')->references('id')->on('plans')->onUpdate('cascade')->onDelete('cascade');
               
                $table->integer('efficiency') ;
                $table->integer('timeliness') ;
                $table->integer('quality') ;
                $table->integer('accuracy') ;
                $table->text('remarks') ;
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
            Schema::dropIfExists('Evaluations');
        }
    }
    