<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Stores sensitive documents (passports, medical reports, exams, devis,
 * dossier pieces) on the PRIVATE local disk (storage/app/private/...), never
 * under public/. Files are only ever served through an authenticated,
 * policy-checked download route.
 */
class SensitiveFileStorage
{
    /** Private disk used for sensitive documents. */
    public const DISK = 'local';

    /** Root folder (relative to the disk) for sensitive files. */
    public const ROOT = 'private';

    /**
     * Store an already-validated uploaded file under private/<category>.
     * Returns the disk-relative path (e.g. "private/quotes/ab12...pdf").
     */
    public static function store(UploadedFile $file, string $category, string $filename): string
    {
        return $file->storeAs(self::ROOT . '/' . trim($category, '/'), $filename, self::DISK);
    }

    /** True when a path points to the private storage area. */
    public static function isPrivate(?string $path): bool
    {
        return is_string($path) && str_starts_with($path, self::ROOT . '/');
    }

    /**
     * Stream a stored document as a download. Handles both the new private
     * paths and the legacy public paths (public/upload/...) so existing rows
     * keep working until they are migrated. Aborts 404 when missing.
     */
    public static function download(?string $path)
    {
        if (empty($path)) {
            abort(404);
        }

        if (Storage::disk(self::DISK)->exists($path)) {
            return Storage::disk(self::DISK)->download($path);
        }

        // Transitional fallback for legacy files still under public/.
        $legacy = public_path(ltrim($path, '/'));
        if (is_file($legacy)) {
            return response()->download($legacy);
        }

        abort(404);
    }

    /** Delete a stored document (used when a file is replaced). */
    public static function delete(?string $path): void
    {
        if (self::isPrivate($path) && Storage::disk(self::DISK)->exists($path)) {
            Storage::disk(self::DISK)->delete($path);
        }
    }
}
