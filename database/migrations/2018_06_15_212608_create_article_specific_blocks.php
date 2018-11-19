<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleSpecificBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cta_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();
            $table->foreign('block_id')
                ->references('id')
                ->on('blocks')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('headline')->nullable();
            $table->text('subhead')->nullable();
            $table->text('copy')->nullable();
            $table->string('cta')->nullable();
            $table->string('url')->nullable();

            $table->integer('position');
			$table->boolean('public');
            $table->timestamps();

            $table->index(['position', 'public']);
			$table->index(['public', 'position']);
        });

        Schema::create('block_image_and_cta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();

            $table->string('layout')->nullable();

            $table->timestamps();
        });

        Schema::create('block_two_column_ctas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();

            $table->string('layout')->nullable();

            $table->timestamps();
        });

        Schema::create('block_two_column_icon_touts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();

            $table->string('headline')->nullable();
            $table->string('eyebrow')->nullable();
            $table->string('theme')->nullable();

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
        Schema::dropIfExists('cta_cards');
        Schema::dropIfExists('block_image_and_cta');
        Schema::dropIfExists('block_two_column_ctas');
        Schema::dropIfExists('block_two_column_icon_touts');
    }
}
