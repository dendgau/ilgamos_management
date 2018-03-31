<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id', false, true);
            $table->integer('product_id', false, true);
            $table->string('product_name_vi');
            $table->string('product_name_en');
            $table->integer('amount', false, true)->default(0);
            $table->bigInteger('unit_price', false, true)->default(0);
            $table->bigInteger('total_price', false, true)->default(0);
            $table->tinyInteger('disable', false, true)->default(0);
            $table->timestamps();

            // Set foreign key
            $table->foreign('contract_id')->references('id')->on('contract');
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
        Schema::table('order_detail', function (Blueprint $table) {
            $table->dropForeign('order_detail_contract_id_foreign');
            $table->dropForeign('order_detail_product_id_foreign');
            $table->dropColumn('contract_id');
            $table->dropColumn('product_id');
        });
        Schema::dropIfExists('order_detail');
    }
}
