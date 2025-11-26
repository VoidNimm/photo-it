<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    protected GoogleTranslate $translator;
    protected string $defaultSourceLang = 'id'; // Bahasa default admin (sesuaikan jika perlu)

    public function __construct()
    {
        $this->translator = new GoogleTranslate();
    }

    /**
     * Translate text otomatis dengan caching
     * 
     * @param string|null $text Text yang akan di-translate
     * @param string $targetLocale Bahasa target (en/id)
     * @return string|null
     */
    public function translate(?string $text, string $targetLocale): ?string
    {
        // Jika text kosong, return langsung
        if (empty($text) || trim($text) === '') {
            return $text;
        }

        // Jika target locale sama dengan bahasa default admin, return asli (tidak perlu translate)
        if ($targetLocale === $this->defaultSourceLang) {
            return $text;
        }

        // Generate cache key unik berdasarkan text dan target locale
        $cacheKey = 'translation:' . $targetLocale . ':' . md5($text);

        // Cek cache dulu, jika ada langsung return
        // Cache disimpan selamanya (atau sampai di-clear manual)
        return Cache::rememberForever($cacheKey, function () use ($text, $targetLocale) {
            try {
                // Set target language
                $this->translator->setTarget($targetLocale);
                
                // Translate text
                $translated = $this->translator->translate($text);
                
                return $translated;
            } catch (\Exception $e) {
                // Jika error (misal offline, rate limit, dll), return text asli
                Log::warning('Translation failed: ' . $e->getMessage(), [
                    'text' => substr($text, 0, 50) . '...',
                    'target' => $targetLocale,
                ]);
                
                return $text; // Fallback ke text asli
            }
        });
    }
}