<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNextDayToRoutineDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routine_days', function (Blueprint $table) {
            // if not exist, add the new column
            if (!Schema::hasColumn('routine_days', 'next_day')) {
                $table->tinyInteger('next_day')->default(0);
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
        Schema::table('routine_days', function (Blueprint $table) {
            $table->dropColumn('next_day');
        });
    }
}
