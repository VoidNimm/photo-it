<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_title',
        'client_image',
        'rating',
        'review_text',
        'is_featured',
        'is_approved',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->client_image) {
            return null;
        }

        // Jika path sudah lengkap dengan storage/, langsung return
        if (str_starts_with($this->client_image, 'storage/')) {
            return asset($this->client_image);
        }

        // Jika path sudah lengkap dengan http/https, langsung return
        if (str_starts_with($this->client_image, 'http')) {
            return $this->client_image;
        }

        // Jika path relatif (testimonials/filename.jpg), tambahkan storage/
        return asset('storage/' . $this->client_image);
    }
}

