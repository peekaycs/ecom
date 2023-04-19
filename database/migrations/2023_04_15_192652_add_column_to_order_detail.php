<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
            $table->string('product_attribute_id')->after('product_id')->nullable();
            $table->float('price',8,2)->default(0)->after('product_attribute_id')->nullable();
            $table->float('discount',8,2)->default(0)->after('price')->nullable();
            $table->float('shipping',8,2)->default(0)->after('discount')->nullable();
            $table->integer('quantity')->after('shipping')->nullable();
            $table->float('total_price',8,2)->default(0)->after('quantity')->nullable();
            $table->float('final_price',8,2)->default(0)->after('total_price')->nullable();
            $table->float('comission',8,2)->default(0)->after('final_price')->nullable();
            $table->float('featured')->default(0)->after('comission')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
        });
    }
}
