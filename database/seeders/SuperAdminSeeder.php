<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('SUPERADMIN_EMAIL', 'superadmin@lspumla.test')],
            [
                'name' => env('SUPERADMIN_NAME', 'Super Admin LSP UMLA'),
                'password' => Hash::make(env('SUPERADMIN_PASSWORD', 'AdminLsp#2026')),
                'role' => 'super_admin',
                'staff_type' => null,
                'is_active' => true,
            ]
        );
    }
}
