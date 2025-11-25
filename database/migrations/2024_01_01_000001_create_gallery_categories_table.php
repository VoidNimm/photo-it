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
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name', 100)->unique()->comment('Nama kategori: City, Wedding, Portrait, dll');
            $table->string('slug', 100)->unique()->comment('URL slug: city, wedding, portrait');
            $table->integer('display_order')->default(0)->comment('Urutan di navbar');
            $table->boolean('is_active')->default(true)->comment('1 = aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_categories');
    }
};

