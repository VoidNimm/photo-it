<?php

namespace Database\Seeders;

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
        // Cek apakah admin sudah ada
        $admin = User::where('email', 'admin1@photoit.com')->first();

        if (!$admin) {
            User::create([
                'name' => 'Admin Photo It',
                'full_name' => 'Admin Photo It',
                'email' => 'admin2@photoit.com',
                'password' => Hash::make('123'),
                'email_verified_at' => now(),
            ]);

            $this->command->info('✅ Admin user created successfully!');
            $this->command->info('📧 Email: admin@photoit.com');
            $this->command->info('🔑 Password: password123');
            $this->command->warn('⚠️  Please change the password after first login!');
        } else {
            $this->command->info('ℹ️  Admin user already exists!');
        }
    }
}
