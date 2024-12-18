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
        Schema::create('product_management', function (Blueprint $table) {
            $table->id();
            $table->text('center_id');
            $table->text('product_id');
            $table->text('user_id');
            $table->text('quantity');
            $table->float('price')->default(0);
            $table->float('cost_price')->default(0);
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_management');
    }
};
