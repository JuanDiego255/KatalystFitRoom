<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutineParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routine_parameters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('general_category_id');           
            $table->integer('quantity');
            $table->integer('day');
            $table->foreign('general_category_id')->references('id')->on('general_categories')->onDelete('cascade');            
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
        Schema::dropIfExists('routine_parameters');
    }
}
