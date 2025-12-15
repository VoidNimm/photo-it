<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\LogsActivity;

class Setting extends Model
{
    use LogsActivity;

    protected $fillable = [
        'key',
        'value',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'array',
        ];
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        return $setting?->value ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Get setting dengan auto-translate berdasarkan locale user saat ini
     * 
     * Admin bisa input bahasa apapun (default: Indonesia), 
     * akan otomatis di-translate ke bahasa yang dipilih user (en/id)
     * 
     * @param string $key Setting key
     * @param mixed $default Default value jika tidak ditemukan
     * @return mixed
     */
    public static function getTranslated(string $key, mixed $default = null): mixed
    {
        // 1. Ambil value asli dari database
        $value = self::get($key, $default);
        
        // 2. Jika value null atau empty, return default
        if ($value === null || $value === '') {
            return $default;
        }
        
        // 3. Ambil locale user saat ini (dari session/middleware)
        $locale = app()->getLocale();
        
        // 4. Jika value adalah string, translate langsung
        if (is_string($value)) {
            $translator = app(\App\Services\TranslationService::class);
            return $translator->translate($value, $locale);
        }
        
        // 5. Jika value adalah array (seperti repeater), return as is
        // Array akan di-handle di controller/view dengan loop khusus
        return $value;
    }
}
