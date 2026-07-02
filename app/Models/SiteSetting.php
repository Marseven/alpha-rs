<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /** Managed image slots (key => human label). */
    public const IMAGE_KEYS = [
        'home_hero_image' => "Image principale (accueil)",
        'about_image' => "Image section À propos",
        'service_banner_image' => "Bannière services",
        'contact_banner_image' => "Bannière contact",
    ];

    private const CACHE_KEY = 'site_settings.map';

    /** All settings as [key => value], cached (invalidated on set). */
    public static function cachedMap(): array
    {
        // Defensive: the table may not exist yet on an un-migrated environment.
        if (! Schema::hasTable('site_settings')) {
            return [];
        }

        return Cache::rememberForever(self::CACHE_KEY, fn () => static::pluck('value', 'key')->all());
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        return (self::cachedMap()[$key] ?? null) ?: $default;
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Resolve an image slot to a usable URL, falling back to a bundled default.
     * Stored values are public paths (e.g. "upload/site/xxx.jpg").
     */
    public static function image(string $key, string $default): string
    {
        $value = static::get($key);

        return $value ? asset($value) : asset($default);
    }
}
