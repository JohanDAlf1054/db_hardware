<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->date('dates');
            $table->string('bill_numbers');    
            $table->string('sellers');
            $table->string('payments_methods');
            $table->string('observations');
            $table->decimal('discounts_total');
            $table->decimal('gross_totals');
            $table->decimal('taxes_total');
            $table->decimal('net_total');
            $table->decimal('values_total');
            $table->bigInteger('clients_id')->unsigned();
            $table->bigInteger('products_id')->unsigned();
            $table->foreign('clients_id')->references('id')->on('people')->onDelete("no action");
            $table->foreign('products_id')->references('id')->on('products')->onDelete("no action");

   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
