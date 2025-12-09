<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom role
            $table->string('role')->default('user')->after('email');
        });

        // Migrate data: is_admin = true -> role = 'admin', is_admin = false -> role = 'user'
        DB::table('users')->where('is_admin', true)->update(['role' => 'admin']);
        DB::table('users')->where('is_admin', false)->update(['role' => 'user']);

        // Hapus kolom is_admin
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kembali is_admin
            $table->boolean('is_admin')->default(false)->after('email');
        });

        // Migrate data kembali
        DB::table('users')->whereIn('role', ['super_admin', 'admin'])->update(['is_admin' => true]);
        DB::table('users')->where('role', 'user')->update(['is_admin' => false]);

        // Hapus kolom role
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
