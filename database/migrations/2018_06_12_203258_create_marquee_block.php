<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarqueeBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_marquee', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();

            $table->string('headline')->nullable();
            $table->text('subhead')->nullable();
            $table->string('cta')->nullable();
            $table->string('url')->nullable();

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
        Schema::dropIfExists('block_marquee');
    }
}
