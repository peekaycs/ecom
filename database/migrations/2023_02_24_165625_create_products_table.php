<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->uuid('id')->primary()->index();
            $table->uuid('user_id')->index();
            $table->string('product')->index();
            $table->uuid('category_id')->index();
            $table->uuid('subcategory_id')->index();
            $table->string('slug')->index();
            $table->string('sku')->nullable();
            $table->float('price',8,2);
            $table->float('discount',8,2)->default(0);
            $table->integer('quantity');
            $table->boolean('published')->default(true);
            $table->boolean('featured')->default(1);
            $table->string('short_description',500)->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('products');
    }
}
