<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id', false, true);
            $table->integer('version_no', false, true)->default(0);
            $table->bigInteger('price', false, true)->default(0);
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
        Schema::table('product_detail', function (Blueprint $table) {
            $table->dropForeign('product_detail_product_id_foreign');
            $table->dropColumn('product_id');
        });
        Schema::dropIfExists('product_detail');
    }
}
