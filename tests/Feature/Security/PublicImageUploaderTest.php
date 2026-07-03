<?php

namespace Tests\Feature\Security;

use App\Http\Controllers\FileController;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * Characterization tests for the public image upload/resize path (picture() /
 * user()), pinned BEFORE it is extracted into App\Services\PublicImageUploader.
 * They freeze the 300x300 minimum-dimension rejection, the success contract
 * (state/url/message + a real 300x300 thumbnail) and the per-method target
 * folder, so the extraction is provably behaviour-preserving.
 */
class PublicImageUploaderTest extends TestCase
{
    /** @var string[] glob patterns of files to remove after each test */
    private array $cleanup = [];

    protected function tearDown(): void
    {
        foreach ($this->cleanup as $glob) {
            foreach (glob($glob) ?: [] as $file) {
                @unlink($file);
            }
        }

        parent::tearDown();
    }

    public function test_undersized_image_is_rejected(): void
    {
        $result = FileController::picture(UploadedFile::fake()->image('small.jpg', 200, 200));

        $this->assertFalse($result['state']);
        $this->assertStringContainsString('trop petites', $result['message']);
    }

    public function test_valid_image_is_stored_and_resized_under_picture_folder(): void
    {
        $this->cleanup[] = public_path('upload/picture/original/pic*');
        $this->cleanup[] = public_path('upload/picture/traite/pic*');

        $result = FileController::picture(UploadedFile::fake()->image('pic.jpg', 600, 600));

        $this->assertTrue($result['state']);
        $this->assertStringStartsWith('/upload/picture/traite/', $result['url']);
        $this->assertSame('Image uploadée avec succès!', $result['message']);

        $thumb = public_path(ltrim($result['url'], '/'));
        $this->assertFileExists($thumb);
        [$w, $h] = getimagesize($thumb);
        $this->assertSame([300, 300], [$w, $h]);
    }

    public function test_user_image_is_stored_under_user_folder(): void
    {
        $this->cleanup[] = public_path('upload/user/original/avatar*');
        $this->cleanup[] = public_path('upload/user/traite/avatar*');

        $result = FileController::user(UploadedFile::fake()->image('avatar.jpg', 600, 600));

        $this->assertTrue($result['state']);
        $this->assertStringStartsWith('/upload/user/traite/', $result['url']);
    }
}
