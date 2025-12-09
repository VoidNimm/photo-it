<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah super admin sudah ada
        $superAdmin = User::where('email', 'superadmin@photoit.com')->first();

        if (!$superAdmin) {
            User::create([
                'name' => 'Super Admin Photo It',
                'email' => 'superadmin@photoit.com',
                'password' => Hash::make('123'),
                'email_verified_at' => now(),
                'role' => UserRole::SuperAdmin,
            ]);

            $this->command->info('✅ Super Admin user created successfully!');
            $this->command->info('📧 Email: superadmin@photoit.com');
            $this->command->info('🔑 Password: 123');
            $this->command->warn('⚠️  Please change the password after first login!');
        } else {
            // Update existing admin jika belum set role
            if (!$superAdmin->isSuperAdmin()) {
                $superAdmin->update(['role' => UserRole::SuperAdmin]);
                $this->command->info('✅ Existing user updated to Super Admin!');
            } else {
                $this->command->info('ℹ️  Super Admin user already exists!');
            }
        }
    }
}