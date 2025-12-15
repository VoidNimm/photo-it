<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action'); // 'created', 'updated', 'deleted'
            $table->string('model_type'); // Nama model class
            $table->unsignedBigInteger('model_id')->nullable(); // ID dari model (nullable untuk deleted)
            $table->string('model_name')->nullable(); // Nama/title dari record
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('user_name'); // Nama user untuk kemudahan query
            $table->json('old_values')->nullable(); // Data sebelum update (untuk updated)
            $table->json('new_values')->nullable(); // Data baru (untuk created/updated)
            $table->string('description')->nullable(); // Deskripsi tambahan
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            $table->index(['model_type', 'model_id']);
            $table->index('user_id');
            $table->index('action');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};