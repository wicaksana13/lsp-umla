<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('assessment_registrations', function (Blueprint $table) {
            $table->string('program_studi')->after('schedule_id')->nullable();
            $table->string('ktp_scan')->after('program_studi')->nullable();
            $table->string('diploma_scan')->after('ktp_scan')->nullable();
            $table->string('payment_proof')->after('diploma_scan')->nullable();
        });
    }

    public function down()
    {
        Schema::table('assessment_registrations', function (Blueprint $table) {
            $table->dropColumn(['program_studi', 'ktp_scan', 'diploma_scan', 'payment_proof']);
        });
    }
};