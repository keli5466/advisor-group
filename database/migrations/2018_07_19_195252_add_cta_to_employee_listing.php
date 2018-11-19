<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCtaToEmployeeListing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('block_employee_listing', function (Blueprint $table) {
            $table->string('cta')->nullable()->after('label');
            $table->string('url')->nullable()->after('cta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('block_employee_listing', function (Blueprint $table) {
            $table->dropColumn('url');
            $table->dropColumn('cta');
        });
    }
}
