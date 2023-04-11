<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->uuid('id')->index()->primary();
            $table->string('transaction_id',255)->index()->unique();
            $table->uuid('order_id')->index();
            $table->enum('mode',['CHEQUE','DD','ONLINE'])->default('ONLINE');
            $table->double('amount',10,2);
            $table->enum('payment_status',['FAILED','SUCCESS']);
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
        Schema::dropIfExists('payment');
    }
}
