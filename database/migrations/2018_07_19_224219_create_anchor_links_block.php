<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnchorLinksBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_anchor_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();

            $table->string('link_label')->nullable();

            $table->timestamps();
        });

        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();
            $table->foreign('block_id')
                ->references('id')
                ->on('blocks')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('anchor')->nullable();

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
        Schema::dropIfExists('block_anchor_links');
        Schema::dropIfExists('links');
    }
}
