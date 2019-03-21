<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            $table->morphs('imageable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::table('images', function (Blueprint $table) {
            $table->unsignedInteger('product_id')->after('id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->dropMorphs('imageable');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}