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
        Schema::create('assessment_registrations', function (Blueprint $table) {

    $table->id();

    $table->foreignId('participant_id')
        ->constrained('users')
        ->cascadeOnDelete();


    $table->foreignId('schedule_id')
        ->constrained('certification_schedules')
        ->cascadeOnDelete();


    $table->enum('status',[
        'menunggu',
        'berlangsung',
        'kompeten',
        'tidak_kompeten'
    ])
    ->default('menunggu');


    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_registrations');
    }
};
