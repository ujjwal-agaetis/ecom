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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('quantity')->unsigned();
            $table->integer('price');
            $table->string('session_id');
            
            // // Add the foreign key column 
            // $table->unsignedBigInteger('session_id');

            // // Define the foreign key constraint
            // $table->foreign('session_id')->references('id')->on('sessions');
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
