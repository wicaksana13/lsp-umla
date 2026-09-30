<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 30)->default('participant')->index();
            $table->string('staff_type', 30)->nullable()->index(); // admin_lsp | asesor
            $table->string('nim', 50)->nullable()->unique();
            $table->string('assessor_no', 100)->nullable()->unique();
            $table->string('phone', 30)->nullable();
            $table->boolean('is_active')->default(true)->index();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['nim']);
            $table->dropUnique(['assessor_no']);
            $table->dropColumn(['role', 'staff_type', 'nim', 'assessor_no', 'phone', 'is_active']);
        });
    }
};
