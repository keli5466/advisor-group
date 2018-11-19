<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHeadlineOnFullBleed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('block_full_bleed_cta', function (Blueprint $table) {
            $table->text('headline')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('block_full_bleed_cta', function (Blueprint $table) {
            $table->string('headline')->nullable()->change();
        });
    }
}
