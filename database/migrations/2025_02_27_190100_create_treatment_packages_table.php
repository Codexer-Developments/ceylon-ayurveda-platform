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
        Schema::create('treatment_packages', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('duration');
            $table->integer('sessions');
            $table->integer('discount');
            $table->integer('status');
            $table->json('treatments');
            $table->json('settings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_packages');
    }
};
