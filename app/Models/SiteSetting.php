<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public static function get(string $key, ?string $default = null): ?string
    {
        // Defensive: the table may not exist yet on an un-migrated environment.
        if (! Schema::hasTable('site_settings')) {
            return $default;
        }

        return static::query()->where('key', $key)->value('value') ?: $default;
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
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
