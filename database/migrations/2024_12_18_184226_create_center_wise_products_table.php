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
        Schema::create('center_wise_products', function (Blueprint $table) {
            $table->id();
            $table->text('center_id');
            $table->text('product_id');
            $table->text('quantity');
            $table->text('price');
            $table->text('cost_price');
            $table->text('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('center_wise_products');
    }
};
