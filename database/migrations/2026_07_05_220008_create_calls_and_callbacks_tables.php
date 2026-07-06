<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('contact_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('agent_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('queue_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('campaign_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('direction', ['inbound', 'outbound'])->default('inbound');
            $table->string('phone_number');
            $table->enum('status', ['completed', 'missed', 'abandoned', 'voicemail', 'busy', 'failed'])->default('completed');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('answered_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->integer('duration')->default(0);
            $table->integer('wait_time')->default(0);
            $table->string('recording_url')->nullable();
            $table->foreignId('disposition_id')->nullable()->constrained()->nullOnDelete();
            $table->text('notes')->nullable();
            $table->string('provider_call_id')->nullable();
            $table->timestamps();
        });

        Schema::create('callbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('contact_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('agent_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('call_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('scheduled_at');
            $table->enum('status', ['pending', 'done', 'missed'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('callbacks');
        Schema::dropIfExists('calls');
    }
};
