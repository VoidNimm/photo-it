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
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('gallery_categories')->nullOnDelete()->comment('ID kategori (opsional)');
            $table->string('title')->comment('Judul foto');
            $table->string('image_path')->comment('Path gambar: gallery/photo1.jpg');
            $table->integer('display_order')->default(0)->comment('Urutan tampil');
            $table->boolean('is_featured')->default(false)->comment('1 = tampil di homepage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};

