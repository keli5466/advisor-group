<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tower_id')->unsigned();
			$table->string('type');

			$table->string('label')->nullable();
			$table->string('slug')->nullable();

			$table->integer('position');
			$table->boolean('public');

			$table->timestamps();

			$table->foreign('tower_id')
                ->references('id')
                ->on('towers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('blocks');
    }
}
