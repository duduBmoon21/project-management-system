<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1496402870EmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('Employees')) {
            Schema::create('Employees', function (Blueprint $table) {
                $table->increments('id');

                $table->integer('dept_id')->unsigned()->nullable();
                $table->foreign('dept_id', '41907_59314bb611908')->references('id')->on('departments')->onDelete('cascade');
                $table->string('name')->nullable();
                $table->string('surname')->nullable();
                $table->string('email')->nullable();
                $table->string('password')->nullable();
                $table->date('birth_date')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('Employees');
    }
}
