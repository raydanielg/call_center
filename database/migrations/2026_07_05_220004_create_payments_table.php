<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscription_id')->nullable()->constrained();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('TZS');
            $table->enum('payment_method', ['mpesa', 'card', 'bank'])->default('mpesa');
            $table->string('reference_number')->nullable();
            $table->enum('status', ['paid', 'pending', 'failed'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
