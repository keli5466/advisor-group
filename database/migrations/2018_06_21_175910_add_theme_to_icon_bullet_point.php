<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThemeToIconBulletPoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('block_copy_and_icon_bullet_point', function (Blueprint $table) {
            $table->string('theme')->nullable()->after('block_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('block_copy_and_icon_bullet_point', function (Blueprint $table) {
            $table->dropColumn('theme');
        });
    }
}
