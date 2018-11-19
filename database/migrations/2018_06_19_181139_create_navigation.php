<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('slug')->nullable();

            $table->string('site');
            $table->boolean('public');
            $table->timestamps();
            
            $table->unique(['slug', 'site']);
        });

        Schema::create('nav_root_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nav_id')->unsigned();
            $table->foreign('nav_id')
                ->references('id')
                ->on('navs')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('title');
            $table->string('url')->nullable();

            $table->integer('position');
			$table->boolean('public');
            $table->timestamps();

            $table->index(['position', 'public']);
			$table->index(['public', 'position']);

        });

        Schema::create('nav_child_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nav_root_link_id')->unsigned();
            $table->foreign('nav_root_link_id')
                ->references('id')
                ->on('nav_root_links')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('title');
            $table->string('url')->nullable();

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
        Schema::dropIfExists('nav_child_links');
        Schema::dropIfExists('nav_root_links');
        Schema::dropIfExists('navs');
    }
}
