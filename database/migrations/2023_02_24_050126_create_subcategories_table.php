<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->uuid('uuid')->index()->unique();
            $table->uuid('category_id')->index();
            $table->foreign('category_id')->references('uuid')->on('categories');
            $table->string('subcategory')->index();
            $table->string('slug')->index();
            $table->string('description',1024)->nullable();
            $table->boolean('status')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('visibility')->default(false);
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
        Schema::dropIfExists('subcategories');
    }
}
