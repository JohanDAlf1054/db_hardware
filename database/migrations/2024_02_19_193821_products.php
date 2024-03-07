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
            $table->string('photo')->nullable();
            $table->string('status');
            $table->string('stock');
            $table->bigInteger('category_products_id')->unsigned();
            $table->bigInteger('brands_id')->unsigned();
            $table->bigInteger('measurement_units_id')->unsigned();
            $table->timestamps();
            $table->foreign('category_products_id')->references('id')->on('category_products')->onDelete("cascade");
            $table->foreign('brands_id')->references('id')->on('brands')->onDelete("cascade");
            $table->foreign('measurement_units_id')->references('id')->on('measurement_units')->onDelete("cascade");
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
