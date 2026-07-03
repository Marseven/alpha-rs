<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;

/**
 * Public image upload + resize (site pictures, user avatars).
 *
 * Writes a web-accessible 300x300 cover-crop under public/upload/<folder>/traite
 * and keeps the source under .../original. Extracted from the byte-identical
 * FileController::picture()/user() pair — now a single folder-parameterized
 * method — separating the public-image concern from the private-document one.
 */
class PublicImageUploader
{
    /** Minimum accepted source dimensions, in pixels. */
    public const WIDTH_MIN = 300;
    public const HEIGHT_MIN = 300;

    /**
     * Store and resize a public image under public/upload/<folder>.
     *
     * @return array{state: bool, url?: string, message: string}
     */
    public static function store(UploadedFile $file, string $folder): array
    {
        $result = [];

        // On récupère les dimensions du fichier.
        $infosImg = getimagesize($file->path());

        if (($infosImg[0] >= self::WIDTH_MIN) && ($infosImg[1] >= self::HEIGHT_MIN)) {
            $filenamewithextension = $file->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            $filenametostore = $filename . '_' . time() . '_300x300.' . $extension;

            $file->move(public_path('/upload/' . $folder . '/original/'), $filename . '.' . $extension);

            $originalpath = public_path('/upload/' . $folder . '/original/' . $filename . '.' . $extension);
            $thumbnailpath = public_path('/upload/' . $folder . '/traite/' . $filenametostore);

            // intervention/image v3: cover() = crop to fill the target box.
            Image::read($originalpath)->cover(300, 300)->save($thumbnailpath);

            $result['state'] = true;
            $result['url'] = '/upload/' . $folder . '/traite/' . $filenametostore;
            $result['message'] = "Image uploadée avec succès!";

            return $result;
        }

        $result['state'] = false;
        $result['message'] = "Les dimensions de votre images sont trop petites, les dimensions minimales recommandées sont 300px X 300px.";

        return $result;
    }
}
