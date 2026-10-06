<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Memastikan tipe ENUM di server lain/production ikut ter-update otomatis saat php artisan migrate
        DB::statement("ALTER TABLE assessment_registrations MODIFY COLUMN status ENUM('menunggu', 'approved', 'berlangsung', 'kompeten', 'tidak_kompeten', 'revisi') NOT NULL DEFAULT 'menunggu'");
    }

    public function down()
    {
        // Kembalikan ke kondisi semula jika di-rollback
        DB::statement("ALTER TABLE assessment_registrations MODIFY COLUMN status ENUM('menunggu', 'approved', 'berlangsung', 'kompeten', 'tidak_kompeten') NOT NULL DEFAULT 'menunggu'");
    }
};