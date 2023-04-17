<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShippingColumnToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->float('shipping',8,2)->default(0)->after('applied_coupon')->nullable();
            $table->string('coupon_code')->after('shipping')->nullable();
            $table->float('coupon_amount',8,2)->default(0)->after('coupon_code')->nullable();
            $table->float('coupon_amount_percent',8,2)->default(0)->after('coupon_amount')->nullable();
            $table->float('payable_amount',8,2)->default(0)->after('coupon_amount_percent')->nullable();
            $table->integer('cart_count')->default(0)->after('payable_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
