<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCtaAndUrlToBlurbs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blurbs', function (Blueprint $table) {
            $table->string('cta')->nullable()->after('copy');
            $table->string('url')->nullable()->after('cta');
        });

        Schema::table('icon_touts', function (Blueprint $table) {
            $table->string('cta')->nullable()->after('copy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blurbs', function (Blueprint $table) {
            $table->dropColumn('url');
            $table->dropColumn('cta');
        });

        Schema::table('icon_touts', function (Blueprint $table) {
            $table->dropColumn('cta');
        });
    }
}
