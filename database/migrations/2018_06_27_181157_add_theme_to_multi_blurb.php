<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThemeToMultiBlurb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('block_multi_blurb', function (Blueprint $table) {
            $table->string('theme')->nullable()->after('copy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('block_multi_blurb', function (Blueprint $table) {
            $table->dropColumn('theme');
        });
    }
}
