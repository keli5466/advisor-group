<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockMultiBlurb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_multi_blurb', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();

            $table->string('headline')->nullable();
            $table->text('copy')->nullable();

            $table->timestamps();
        });

        Schema::create('blurbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();
            $table->foreign('block_id')
                ->references('id')
                ->on('blocks')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('headline')->nullable();
            $table->text('copy')->nullable();

            $table->integer('position');
			$table->boolean('public');
            $table->timestamps();

            $table->index(['position', 'public']);
			$table->index(['public', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block_multi_blurb');
        Schema::dropIfExists('blurbs');
    }
}
