<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCtaOptionToMarquee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('block_marquee', function (Blueprint $table) {
            $table->text('button_type')->nullable()->after('eyebrow');
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
            $table->dropColumn('button_type');
        });
    }
}
