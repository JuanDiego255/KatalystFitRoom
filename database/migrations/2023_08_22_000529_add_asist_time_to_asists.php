<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAsistTimeToAsists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asists', function (Blueprint $table) {
            // if not exist, add the new column
            if (!Schema::hasColumn('asists', 'asist_time')) {
                $table->string('asist_time');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asists', function (Blueprint $table) {
            $table->dropColumn('asist_time');
        });
    }
}
