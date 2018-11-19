<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockCopyAndImage extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('block_copy_and_image', function (Blueprint $table) {
						$table->increments('id');
						$table->integer('block_id')->unsigned();

						$table->string('headline')->nullable();
						$table->text('subhead')->nullable();
						$table->string('layout')->nullable();
						$table->string('image_width')->nullable();
						$table->text('copy')->nullable();
						$table->text('video')->nullable();

						$table->timestamps();
				});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
				Schema::dropIfExists('block_copy_and_image');
		}
}
