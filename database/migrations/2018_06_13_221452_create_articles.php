<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('slug');
            $table->text('abstract')->nullable();


            $table->string('eyebrow')->nullable();
            $table->longtext('body')->nullable();

            $table->text('description')->nullable();

            $table->string('site');
            $table->boolean('public');
            $table->timestamps();

            $table->unique(['slug', 'site']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
