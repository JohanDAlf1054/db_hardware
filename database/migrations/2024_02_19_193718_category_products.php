<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryProducts extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_products', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->bigInteger('sub_categories_id')->unsigned();
            $table->timestamps();
            $table->foreign('sub_categories_id')->references('id')->on('sub_categories')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_products');
    }
};
