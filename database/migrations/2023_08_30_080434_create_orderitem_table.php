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
        Schema::create('orderitem', function (Blueprint $table) {
            $table->id();
            // Add the foreign key column
            $table->unsignedBigInteger('order_id');
            $table->string('item_name');
            $table->integer('quantity')->unsigned();
            $table->integer('price');
            $table->integer('product_id');
            
            // Define the foreign key constraint
            $table->foreign('order_id')->references('id')->on('orders');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderitem');
    }
};
