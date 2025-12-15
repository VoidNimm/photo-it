<?php

namespace App\Concerns;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected static function bootLogsActivity(): void
    {
        static::created(function (Model $model) {
            self::logActivity($model, 'created');
        });

        static::updated(function (Model $model) {
            self::logActivity($model, 'updated', $model->getOriginal());
        });

        static::deleted(function (Model $model) {
            self::logActivity($model, 'deleted');
        });
    }

    protected static function logActivity(Model $model, string $action, ?array $oldValues = null): void
    {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();

        $modelName = self::getModelName($model);
        $description = self::generateDescription($model, $action);

        $attributes = match($action) {
            'created' => [
                'new_values' => self::serializeAttributes($model->getAttributes()),
            ],
            'updated' => [
                'old_values' => self::serializeAttributes($oldValues ?? []),
                'new_values' => self::serializeAttributes(
                    array_diff_assoc(
                        self::serializeAttributes($model->getAttributes()),
                        self::serializeAttributes($oldValues ?? [])
                    )
                ),
            ],
            'deleted' => [
                'old_values' => self::serializeAttributes($model->getAttributes()),
            ],
            default => [],
        };

        ActivityLog::create(array_merge([
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $action === 'deleted' ? null : $model->getKey(),
            'model_name' => $modelName,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ], $attributes));
    }

    /**
     * Konversi attributes menjadi format yang bisa di-serialize ke JSON
     * Mengkonversi enum, Carbon, dll menjadi string/array
     */
    protected static function serializeAttributes(array $attributes): array
    {
        return array_map(function ($value) {
            // Jika enum, ambil value-nya
            if ($value instanceof \BackedEnum) {
                return $value->value;
            }

            // Jika UnitEnum, ambil name-nya
            if ($value instanceof \UnitEnum) {
                return $value->name;
            }

            // Jika Carbon/DateTime, convert ke string
            if ($value instanceof \DateTimeInterface) {
                return $value->format('Y-m-d H:i:s');
            }

            // Jika array, rekursif
            if (is_array($value)) {
                return self::serializeAttributes($value);
            }

            // Jika object lain, coba toArray() atau toString()
            if (is_object($value)) {
                if (method_exists($value, 'toArray')) {
                    return self::serializeAttributes($value->toArray());
                }
                if (method_exists($value, '__toString')) {
                    return (string) $value;
                }
                // Fallback: convert ke array
                return self::serializeAttributes((array) $value);
            }

            return $value;
        }, $attributes);
    }

    protected static function getModelName(Model $model): string
    {
        // Coba berbagai field yang umum digunakan sebagai nama
        $nameFields = ['name', 'title', 'service_name', 'category_name', 'email'];

        foreach ($nameFields as $field) {
            if (isset($model->{$field})) {
                return (string) $model->{$field};
            }
        }

        // Fallback ke ID
        return '#'.$model->getKey();
    }

    protected static function generateDescription(Model $model, string $action): string
    {
        $modelLabel = class_basename($model);
        $modelName = self::getModelName($model);

        return match($action) {
            'created' => "Menambah {$modelLabel}: {$modelName}",
            'updated' => "Mengubah {$modelLabel}: {$modelName}",
            'deleted' => "Menghapus {$modelLabel}: {$modelName}",
            default => "{$action} {$modelLabel}: {$modelName}",
        };
    }
}