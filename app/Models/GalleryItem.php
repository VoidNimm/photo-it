<?php

namespace App\Models;

use App\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'category_id',
        'title',
        'image_path',
        'display_order',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }

    // Helper untuk mendapatkan URL gambar
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return null;
        }

        // Jika path sudah lengkap dengan storage/, langsung return
        if (str_starts_with($this->image_path, 'storage/')) {
            return asset($this->image_path);
        }

        // Jika path relatif, tambahkan storage/
        return asset('storage/' . $this->image_path);
    }
}

