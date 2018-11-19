<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PolymorphicBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropForeign(['tower_id']);
            $table->renameColumn('tower_id', 'blockable_id');
            $table->string('blockable_type')->after('id');
        });
        DB::table('blocks')->update([
            'blockable_type' => 'App\Tower',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropColumn('blockable_type');
            $table->renameColumn('blockable_id', 'tower_id');
        });
    }
}
