<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('general_category_id');
           
            $table->unsignedBigInteger('exercise_id');
            $table->string('alt')->nullable();
            $table->string('series')->nullable();
            $table->string('reps')->nullable();  
            $table->string('weight')->nullable();   
            $table->string('status')->nullable();        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('general_category_id')->references('id')->on('general_categories')->onDelete('cascade');
           
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
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
        Schema::dropIfExists('routines');
    }
}
