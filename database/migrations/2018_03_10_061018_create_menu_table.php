<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id', false, true);
            $table->integer('product_type', false, true)->default(0);
            $table->tinyInteger('disable', false, true)->default(0);
            $table->timestamps();

            // Set foreign key
            $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropForeign('menu_product_id_foreign');
            $table->dropColumn('product_id');
        });
        Schema::dropIfExists('menu');
    }
}
