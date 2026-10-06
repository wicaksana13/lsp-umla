<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('participant_registrations', function (Blueprint $table) {
            $table->date('birth_date')->after('phone')->nullable();
        });
    }

    public function down()
    {
        Schema::table('participant_registrations', function (Blueprint $table) {
            $table->dropColumn('birth_date');
        });
    }
};