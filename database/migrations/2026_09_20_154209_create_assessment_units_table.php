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
        Schema::create('assessment_units', function(Blueprint $table){

    $table->id();


    $table->foreignId(
        'assessment_registration_id'
    )
    ->constrained()
    ->cascadeOnDelete();


    $table->string('code');

    $table->string('unit_name');


    $table->enum('result',[
        'kompeten',
        'tidak_kompeten'
    ])
    ->default('tidak_kompeten');


    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_units');
    }
};
