<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void { Schema::create('certificates', function (Blueprint $table) {
        $table->id(); $table->foreignId('participant_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('certification_scheme_id')->constrained()->cascadeOnDelete();
        $table->string('certificate_no')->unique(); $table->date('issued_at'); $table->date('expires_at')->nullable();
        $table->string('file_path')->nullable(); $table->string('status', 20)->default('issued')->index();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete(); $table->timestamps();
    }); }
    public function down(): void { Schema::dropIfExists('certificates'); }
};
