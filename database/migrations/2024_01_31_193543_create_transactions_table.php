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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('reference')->unique();
            $table->string('api_reference')->unique()->nullable();
            $table->string('description');
            $table->double('balance_before');
            $table->double('balance_after');
            $table->double('amount');
            $table->double('requested_amount');
            $table->unsignedInteger('fees');
            $table->string('currency')->default('NGN');
            $table->timestamp('paid_at');
            $table->json('metadata')->nullable();
            $table->string('type');
            $table->string('status');
            $table->string('channel');
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
