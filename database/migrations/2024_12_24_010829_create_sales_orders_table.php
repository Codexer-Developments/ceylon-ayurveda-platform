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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->foreignId('center_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('delivery_status')->default('pending');
            $table->string('delivery_method')->nullable();
            $table->float('cash_balance')->default(0);
            $table->float('total_amount')->default(0);
            $table->float('discount')->default(0);
            $table->float('tax')->default(0);
            $table->float('grand_total')->default(0);
            $table->float('paid_amount')->default(0);
            $table->float('due_amount')->default(0);
            $table->float('return_amount')->default(0);
            $table->json('order_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
