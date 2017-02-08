<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            // The ID of the product
            $table->increments('id');
            // The name of the product
            $table->string('name');

            $table->text('description')->nullable();

            $table->double('price', 10, 2)->default($default = 0);

            $table->string('units')->nullable();

            $table->boolean('promo')->default(false);

            $table->string('image')->nullable();

            $table->integer('category_id')->default($default = 1)->unsigned();

            // created_at and modified_at columns
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
