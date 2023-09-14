<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identification')->unique();;
            $table->string('birthdate');
            $table->string('sex');
            $table->string('telephone');
            $table->string('whatsapp');
            $table->string('tutor');
            $table->string('address');
            $table->string('height');
            $table->string('weight')->default('0');
            $table->string('body_index')->default('0');
            $table->text('injuries')->nullable();
            $table->string('sick')->nullable();
            $table->text('sport_Activity')->nullable();
            $table->string('contact_emergency');
            $table->string('blood_type');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role_as')->default('0');           
            $table->tinyInteger('anemia')->default('0'); ;
            $table->tinyInteger('suffocation')->default('0'); 
            $table->tinyInteger('asthmatic')->default('0');
            $table->tinyInteger('epileptic')->default('0'); 
            $table->tinyInteger('diabetic')->default('0'); 
            $table->tinyInteger('smoke')->default('0'); 
            $table->tinyInteger('gender')->default('0'); 
            $table->string('dizziness')->nullable();
            $table->string('fainting')->nullable();
            $table->string('nausea')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
