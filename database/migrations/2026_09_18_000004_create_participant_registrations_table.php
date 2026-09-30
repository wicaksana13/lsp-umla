<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void { Schema::create('participant_registrations', function (Blueprint $table) {
        $table->id(); $table->string('nim', 50)->unique(); $table->string('name');
        $table->string('email'); $table->string('phone', 30)->nullable();
        $table->foreignId('certification_scheme_id')->nullable()->constrained()->nullOnDelete();
        $table->string('status', 20)->default('pending')->index();
        $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
        $table->timestamp('approved_at')->nullable(); $table->text('rejection_note')->nullable();
        $table->timestamps();
    }); }
    public function down(): void { Schema::dropIfExists('participant_registrations'); }
};
