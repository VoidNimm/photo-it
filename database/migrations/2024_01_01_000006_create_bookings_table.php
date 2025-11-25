<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number', 50)->unique()->comment('Nomor booking: BK-2024-001');
            $table->string('client_name')->comment('Nama klien');
            $table->string('client_email')->comment('Email klien');
            $table->string('client_phone', 50)->comment('Telepon klien');
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete()->comment('ID layanan');
            $table->date('event_date')->nullable()->comment('Tanggal acara');
            $table->string('location')->nullable()->comment('Lokasi acara');
            $table->text('notes')->nullable()->comment('Catatan');
            $table->string('booking_status', 50)->default('pending')->comment('pending, confirmed, completed, cancelled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

