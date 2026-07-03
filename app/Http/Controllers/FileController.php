<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Quote;
use App\Services\PublicImageUploader;
use App\Services\SensitiveFileStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileController extends Controller
{
    /** Extensions accepted for uploaded documents (devis / dossiers). */
    const ALLOWED_DOC_EXTENSIONS = ['pdf', 'jpg', 'jpeg', 'png'];

    /** Real MIME types accepted for uploaded documents. */
    const ALLOWED_DOC_MIMES = [
        'application/pdf',
        'image/jpeg',
        'image/pjpeg',
        'image/png',
    ];

    /** Max upload size for a document, in bytes (10 MB). */
    const MAX_DOC_SIZE = 10 * 1024 * 1024;

    /**
     * Validate an uploaded document against the extension / MIME / size
     * whitelist. Returns an error message, or null when the file is safe.
     * This is what blocks .sql / .php / .env / .zip / ... uploads.
     */
    protected static function documentUploadError(UploadedFile $file): ?string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        if (! in_array($extension, self::ALLOWED_DOC_EXTENSIONS, true)) {
            return "Type de fichier non autorisé (.$extension). Formats acceptés : PDF, JPG, PNG.";
        }

        if (! in_array($file->getMimeType(), self::ALLOWED_DOC_MIMES, true)) {
            return "Le contenu du fichier ne correspond pas à un PDF ou une image.";
        }

        if ($file->getSize() > self::MAX_DOC_SIZE) {
            return "Fichier trop volumineux (10 Mo maximum).";
        }

        return null;
    }

    /** Server-generated, collision-free filename. The original name is never used. */
    protected static function safeFilename(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        return bin2hex(random_bytes(16)) . '.' . $extension;
    }


    /**
     * Display all annonce in specified category.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    /** Store + resize a site picture (public/upload/picture). */
    static function picture(UploadedFile $request)
    {
        return PublicImageUploader::store($request, 'picture');
    }

    /** Store + resize a user avatar (public/upload/user). */
    static function user(UploadedFile $request)
    {
        return PublicImageUploader::store($request, 'user');
    }

    static function folder_file(UploadedFile $request)
    {
        return self::storeDocument($request, 'documents');
    }

    static function quote_file(UploadedFile $request)
    {
        return self::storeDocument($request, 'quotes');
    }

    /**
     * Validate and store an uploaded document on the PRIVATE disk using a
     * server-generated filename. Dangerous files are rejected before any
     * write happens. The returned path (e.g. "private/quotes/ab..pdf") is not
     * web-accessible and must be served through a download route.
     */
    protected static function storeDocument(?UploadedFile $request, string $category): array
    {
        if ($request == null) {
            return ['state' => false, 'message' => "Le fichier n'a pas été uploadé"];
        }

        if ($error = self::documentUploadError($request)) {
            return ['state' => false, 'message' => $error];
        }

        $path = SensitiveFileStorage::store($request, $category, self::safeFilename($request));

        return [
            'state' => true,
            'url' => $path,
            'message' => "Fichier uploadé avec succès!",
        ];
    }

    /**
     * Authenticated, policy-checked download of a quote document.
     * Only whitelisted fields are downloadable; the path never comes from the
     * request (it is read from the model column).
     */
    public function downloadQuote(Quote $quote, string $field)
    {
        $this->authorize('view', $quote);

        $map = [
            'passport' => 'join_piece_passport',
            'rapport' => 'join_piece_rapport',
            'exam' => 'join_piece_exam',
            'devis' => 'devis',
            'piece' => 'join_piece',
        ];
        abort_unless(isset($map[$field]), 404);

        return SensitiveFileStorage::download($quote->{$map[$field]});
    }

    /** Authenticated, policy-checked download of a folder document. */
    public function downloadFolder(Folder $folder, string $field)
    {
        $this->authorize('view', $folder);

        $map = ['piece' => 'join_piece'];
        abort_unless(isset($map[$field]), 404);

        return SensitiveFileStorage::download($folder->{$map[$field]});
    }

    static function destroy($image)
    {
        Storage::disk('s3')->delete($image);
        return back()->withSuccess('Image a été supprimé avec succès.');
    }
}
