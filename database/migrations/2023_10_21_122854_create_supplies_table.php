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
        // Migration for the Supplies table
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->integer('quantity_purchased');
            $table->decimal('unit_purchase_price', 20, 2);
            $table->dateTime('supply_date');
            $table->boolean('supply_status')->default(false);
            $table->integer('quantity_in_stock')->default(0);
            $table->date('expiration_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies');
    }
};
