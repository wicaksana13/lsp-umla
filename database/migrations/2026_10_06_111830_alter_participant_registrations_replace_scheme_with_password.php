<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('participant_registrations', function (Blueprint $table) {
            // Jika certification_scheme_id adalah foreign key, hapus constraint-nya dulu (hapus baris ini jika bukan foreign key)
            $table->dropForeign(['certification_scheme_id']); 
            
            // Hapus kolom
            $table->dropColumn('certification_scheme_id');
            
            // Tambah kolom password
            $table->string('password')->after('phone');
        });
    }

    public function down()
    {
        Schema::table('participant_registrations', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->unsignedBigInteger('certification_scheme_id')->nullable();
        });
    }
};