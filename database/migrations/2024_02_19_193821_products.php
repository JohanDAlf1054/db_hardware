<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function(Blueprint $table){
        $table->engine="InnoDB";
        $table->bigIncrements('id');
        $table->string('name_product');
        $table->string('description_long');
        $table->string('factory_reference');
        $table->string('classification_tax');
        $table->string('selling_price');
        $table->string('photo')->nullable();
        $table->boolean('status')->default(True);
        $table->string('stock')->default(0);
        $table->bigInteger('category_products_id')->unsigned();
        $table->bigInteger('brands_id')->unsigned();
        $table->bigInteger('measurement_units_id')->unsigned();
        $table->timestamps();
        $table->foreign('category_products_id')->references('id')->on('category_products')->onDelete("no action");
        $table->foreign('brands_id')->references('id')->on('brands')->onDelete("no action");
        $table->foreign('measurement_units_id')->references('id')->on('measurement_units')->onDelete("no action");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
