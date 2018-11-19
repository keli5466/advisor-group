<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockCopyAndIconBulletPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icon_touts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();
            $table->foreign('block_id')
                ->references('id')
                ->on('blocks')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('headline')->nullable();
            $table->string('copy')->nullable();

            $table->integer('position');
			$table->boolean('public');
            $table->timestamps();

            $table->index(['position', 'public']);
			$table->index(['public', 'position']);
        });

        Schema::create('block_copy_and_icon_bullet_point', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();

            $table->string('headline')->nullable();
            $table->text('copy')->nullable();

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
        Schema::dropIfExists('icon_tout');
        Schema::dropIfExists('block_copy_and_icon_bullet_points');
    }
}
