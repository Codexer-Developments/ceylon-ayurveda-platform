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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->text('address');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('tex_id')->nullable();
            $table->string('insurance_id')->nullable();
            $table->string('insurance_name')->nullable();
            $table->string('insurance_group')->nullable();
            $table->string('insurance_type')->nullable();
            $table->string('blood_group')->nullable();
            $table->date('dob');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
