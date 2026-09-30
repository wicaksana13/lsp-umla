<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void { Schema::create('certification_schedules', function (Blueprint $table) {
        $table->id(); $table->string('title');
        $table->foreignId('certification_scheme_id')->constrained()->cascadeOnDelete();
        $table->foreignId('tuk_id')->nullable()->constrained('tuks')->nullOnDelete();
        $table->foreignId('assessor_id')->nullable()->constrained('users')->nullOnDelete();
        $table->date('date'); $table->time('start_time')->nullable(); $table->time('end_time')->nullable();
        $table->string('mode', 20)->default('offline'); $table->unsignedInteger('quota')->default(0);
        $table->string('status', 20)->default('open')->index(); $table->text('notes')->nullable(); $table->timestamps();
    }); }
    public function down(): void { Schema::dropIfExists('certification_schedules'); }
};
