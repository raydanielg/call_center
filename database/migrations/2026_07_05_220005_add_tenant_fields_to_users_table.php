<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('tenant_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->string('avatar')->nullable()->after('password');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('avatar');
            $table->enum('agent_status', ['available', 'on_call', 'break', 'offline'])->default('offline')->after('status');
            $table->string('extension_number')->nullable()->after('agent_status');
            $table->timestamp('last_login_at')->nullable()->after('extension_number');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropColumn(['tenant_id', 'avatar', 'status', 'agent_status', 'extension_number', 'last_login_at']);
        });
    }
};
