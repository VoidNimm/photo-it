<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'model_type',
        'model_id',
        'model_name',
        'user_id',
        'user_name',
        'old_values',
        'new_values',
        'description',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function model()
    {
        return $this->morphTo('model', 'model_type', 'model_id');
    }

    public function getActionLabelAttribute(): string
    {
        return match($this->action) {
            'created' => 'Dibuat',
            'updated' => 'Diupdate',
            'deleted' => 'Dihapus',
            default => $this->action,
        };
    }

    public function getModelLabelAttribute(): string
    {
        $modelName = class_basename($this->model_type);
        
        return match($modelName) {
            'GalleryCategory' => 'Kategori Gallery',
            'GalleryItem' => 'Item Gallery',
            'Service' => 'Layanan',
            'Testimonial' => 'Testimonial',
            'Booking' => 'Booking',
            'ContactMessage' => 'Pesan Kontak',
            'Setting' => 'Pengaturan',
            'User' => 'Pengguna',
            'Pricing' => 'Harga',
            default => $modelName,
        };
    }
}