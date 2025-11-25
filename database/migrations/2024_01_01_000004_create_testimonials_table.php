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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->comment('Nama pelanggan');
            $table->string('client_title')->nullable()->comment('Jabatan: CEO, Designer, dll');
            $table->string('client_image')->nullable()->comment('Path foto pelanggan');
            $table->integer('rating')->default(5)->comment('Rating 1-5');
            $table->text('review_text')->comment('Isi testimoni');
            $table->boolean('is_featured')->default(false)->comment('1 = tampil di homepage');
            $table->boolean('is_approved')->default(false)->comment('1 = sudah disetujui');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};

