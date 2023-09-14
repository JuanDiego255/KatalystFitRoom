<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToGeneralCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_categories', function (Blueprint $table) {
            // if not exist, add the new column
            if (!Schema::hasColumn('general_categories', 'image')) {
                $table->string('image');
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
        Schema::table('general_categories', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
