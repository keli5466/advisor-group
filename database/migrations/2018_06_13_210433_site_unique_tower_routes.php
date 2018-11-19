<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SiteUniqueTowerRoutes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('towers', function (Blueprint $table) {
            $table->dropUnique(['route']);
            $table->unique(['site', 'route']);
            $table->index('public');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('towers', function (Blueprint $table) {
            $table->dropUnique(['site', 'route']);
            $table->unique(['route']);
            $table->dropIndex(['public']);
        });
    }
}
