<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHideFormOptionToMarquee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('block_marquee', function (Blueprint $table) {
            $table->string('hide_form')->nullable()->after('button_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('block_marquee', function (Blueprint $table) {
            $table->dropColumn('hide_form');
        });
    }
}
