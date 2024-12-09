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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();  
            $table->string('postal_code', 9);
            $table->string('street', 255);
            $table->string('number')->nullable();
            $table->string('additional_information', 255)->nullable();;
            $table->string('neighborhood', 50);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
