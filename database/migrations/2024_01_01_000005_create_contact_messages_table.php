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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nama pengirim');
            $table->string('email')->comment('Email pengirim');
            $table->string('subject')->comment('Subjek pesan');
            $table->text('message')->comment('Isi pesan');
            $table->string('phone', 50)->nullable()->comment('Nomor telepon');
            $table->boolean('is_read')->default(false)->comment('1 = sudah dibaca');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};

