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
        Schema::create('people', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->enum('rol',['Cliente','Proveedor']);
            $table->enum('identification_type',['CC','CE','DIE','TI','RC','TE','NIT','PP','NUIP','NITO','PEP']);
            $table->string('identification_number',45)->unique();
            $table->enum('person_type',['Persona natural', 'Persona jurídica']);
            $table->string('company_name',45)->nullable()->unique();
            $table->string('comercial_name',45)->nullable()->unique();
            $table->string('first_name',45)->nullable();
            $table->string('other_name',45)->nullable();
            $table->string('surname',45)->nullable();
            $table->string('second_surname',45)->nullable();
            $table->string('digit_verification',10);
            $table->string('email_address',45);
            $table->string('city',100);
            $table->string('address',100);
            $table->string('phone',100);
            $table->boolean('status')->default(True);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
