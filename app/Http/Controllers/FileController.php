<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

define('WIDTH_MIN', 300);     // Largeur max de l'image en pixels
define('HEIGHT_MIN', 300);
// todo: specified size to user

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
    static function picture(UploadedFile $request)
    {
        $result = [];

        if ($request != NULL) {

            // On recupere les dimensions du fichier
            $infosImg = getimagesize($request->path());

            //dd($infosImg);

            if (($infosImg[0] >= WIDTH_MIN) && ($infosImg[1] >= HEIGHT_MIN)) {
                //get filename with extension
                $filenamewithextension = $request->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $request->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename . '_' . time() . '_300x300.' . $extension;

                //Upload File
                $request->move(public_path('/upload/picture/original/'),  $filename . '.' . $extension);

                //Resize image here
                $originalpath = public_path('/upload/picture/original/' . $filename . '.' . $extension);
                $thumbnailpath = public_path('/upload/picture/traite/' . $filenametostore);

                $img = Image::make($originalpath)->fit(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->interlace(true);
                $img->save($thumbnailpath);

                $filePath_originale = '/upload/picture/original/' . $filename . '.' . $extension;
                $filePath_traite = '/upload/picture/traite/' . $filenametostore;

                $result['state'] = true;
                $result['url'] =  $filePath_traite;
                $result['message'] = "Image uploadée avec succès!";

                return $result;
                //change the route as per your flow
            } else {
                $result['state'] = false;
                $result['message'] = "Les dimensions de votre images sont trop petites, les dimensions minimales recommandées sont 300px X 300px.";

                return $result;
            }
        } else {
            $result['state'] = false;
            $result['message'] = "Image n\'a pas été uploadé";

            return $result;
        }
    }

    static function user(UploadedFile $request)
    {
        $result = [];

        if ($request != NULL) {

            // On recupere les dimensions du fichier
            $infosImg = getimagesize($request->path());

            //dd($infosImg);

            if (($infosImg[0] >= WIDTH_MIN) && ($infosImg[1] >= HEIGHT_MIN)) {
                //get filename with extension
                $filenamewithextension = $request->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $request->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename . '_' . time() . '_300x300.' . $extension;

                //Upload File
                $request->move(public_path('/upload/user/original/'),  $filename . '.' . $extension);

                //Resize image here
                $originalpath = public_path('/upload/user/original/' . $filename . '.' . $extension);
                $thumbnailpath = public_path('/upload/user/traite/' . $filenametostore);

                $img = Image::make($originalpath)->fit(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->interlace(true);
                $img->save($thumbnailpath);

                $filePath_originale = '/upload/user/original/' . $filename . '.' . $extension;
                $filePath_traite = '/upload/user/traite/' . $filenametostore;

                $result['state'] = true;
                $result['url'] =  $filePath_traite;
                $result['message'] = "Image uploadée avec succès!";

                return $result;
                //change the route as per your flow
            } else {
                $result['state'] = false;
                $result['message'] = "Les dimensions de votre images sont trop petites, les dimensions minimales recommandées sont 300px X 300px.";

                return $result;
            }
        } else {
            $result['state'] = false;
            $result['message'] = "Image n\'a pas été uploadé";

            return $result;
        }
    }

    static function folder_file(UploadedFile $request)
    {
        return self::storeDocument($request, '/upload/documents/');
    }

    static function quote_file(UploadedFile $request)
    {
        return self::storeDocument($request, '/upload/quote/');
    }

    /**
     * Validate and store an uploaded document under public/ using a
     * server-generated filename. Dangerous files are rejected before any
     * write happens.
     */
    protected static function storeDocument(?UploadedFile $request, string $relativeDir): array
    {
        if ($request == null) {
            return ['state' => false, 'message' => "Le fichier n'a pas été uploadé"];
        }

        if ($error = self::documentUploadError($request)) {
            return ['state' => false, 'message' => $error];
        }

        $filenametostore = self::safeFilename($request);
        $request->move(public_path($relativeDir), $filenametostore);

        return [
            'state' => true,
            'url' => rtrim($relativeDir, '/') . '/' . $filenametostore,
            'message' => "Fichier uploadé avec succès!",
        ];
    }

    static function destroy($image)
    {
        Storage::disk('s3')->delete($image);
        return back()->withSuccess('Image a été supprimé avec succès.');
    }
}
