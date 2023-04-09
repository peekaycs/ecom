<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->uuid('id')->index()->primary();
            $table->uuid('user_id')->index();
            $table->double('total',10,2);
            $table->double('discount',10,2)->nullable();
            $table->string('applied_coupon',64)->nullable();    
            $table->enum('payment_mode',['COD','CHEQUE','DD','ONLINE']);
            $table->enum('payment_status',['PAID','PAYMENT_PENDING']);
            $table->uuid('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->dateTime('payment_date')->nullable();
            $table->enum('shipping_status',['PENDING','CONFIRMED','ON HOLD','SHIPPED','IN TRANSIT','DELIVERED','CANCELLED','RETURNED','RETURNED DELIVERED','COMPLETED']);
            $table->dateTime('shipping_date')->nullable();
            $table->uuid('shipping_address');
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
        Schema::dropIfExists('orders');
    }
}
