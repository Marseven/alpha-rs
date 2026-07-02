<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SiteSettingController extends Controller
{
    private const ALLOWED_MIMES = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/webp'];
    private const MAX_BYTES = 4 * 1024 * 1024; // 4 MB

    public function index()
    {
        $images = [];
        foreach (SiteSetting::IMAGE_KEYS as $key => $label) {
            $images[$key] = ['label' => $label, 'value' => SiteSetting::get($key)];
        }

        return view('admin.site.images', ['images' => $images, 'title' => 'Images du site']);
    }

    public function update(Request $request)
    {
        $rules = [];
        foreach (array_keys(SiteSetting::IMAGE_KEYS) as $key) {
            $rules[$key] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096';
        }
        $request->validate($rules);

        $updated = 0;
        foreach (array_keys(SiteSetting::IMAGE_KEYS) as $key) {
            $file = $request->file($key);
            if (! $file) {
                continue;
            }
            if ($error = $this->rejectUnsafe($file)) {
                return back()->with('error', "{$key} : {$error}");
            }
            $path = $this->store($file);
            SiteSetting::set($key, $path);
            $updated++;
        }

        return back()->with('success', $updated > 0
            ? "$updated image(s) mise(s) à jour."
            : "Aucune image sélectionnée.");
    }

    private function rejectUnsafe(UploadedFile $file): ?string
    {
        if (! in_array($file->getMimeType(), self::ALLOWED_MIMES, true)) {
            return 'format non autorisé (JPG, PNG ou WEBP uniquement).';
        }
        if ($file->getSize() > self::MAX_BYTES) {
            return 'image trop volumineuse (4 Mo maximum).';
        }

        return null;
    }

    private function store(UploadedFile $file): string
    {
        $name = bin2hex(random_bytes(16)) . '.' . strtolower($file->getClientOriginalExtension());
        $file->move(public_path('upload/site'), $name);

        return 'upload/site/' . $name;
    }
}
