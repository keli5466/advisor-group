<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFloatLogoPositionToBlockMarquee extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('block_marquee', function (Blueprint $table) {
			$table->string('float_logo_position')->nullable()->after('hide_form');
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
			$table->dropColumn('float_logo_position');
		});
	}
}
