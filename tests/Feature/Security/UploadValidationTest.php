<?php

namespace Tests\Feature\Security;

use App\Http\Controllers\FileController;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Uploaded documents must be restricted to safe types. Dangerous files
 * (.sql/.php/.env/.zip/...) and oversized files must be rejected BEFORE any
 * write to disk.
 */
class UploadValidationTest extends TestCase
{
    #[DataProvider('dangerousFiles')]
    public function test_dangerous_document_uploads_are_rejected(string $name): void
    {
        $file = UploadedFile::fake()->create($name, 10, 'application/octet-stream');

        $result = FileController::quote_file($file);

        $this->assertFalse($result['state'], "$name should be rejected.");
    }

    public static function dangerousFiles(): array
    {
        return [
            ['dump.sql'],
            ['shell.php'],
            ['secrets.env'],
            ['archive.zip'],
            ['script.js'],
            ['page.html'],
            ['tool.exe'],
            ['run.sh'],
        ];
    }

    public function test_oversized_document_is_rejected(): void
    {
        // 11 MB > 10 MB limit
        $file = UploadedFile::fake()->create('big.pdf', 11 * 1024, 'application/pdf');

        $result = FileController::quote_file($file);

        $this->assertFalse($result['state']);
    }

    public function test_folder_file_also_rejects_dangerous_uploads(): void
    {
        $file = UploadedFile::fake()->create('payload.php', 10, 'application/octet-stream');

        $this->assertFalse(FileController::folder_file($file)['state']);
    }

    public function test_legitimate_image_upload_is_accepted_and_renamed(): void
    {
        $file = UploadedFile::fake()->image('passport.jpg', 600, 600);

        $result = FileController::quote_file($file);

        $this->assertTrue($result['state']);
        // Original name must not be reused as the stored path.
        $this->assertStringNotContainsString('passport', $result['url']);

        // Cleanup the file written to public/upload/quote.
        $stored = public_path($result['url']);
        if (is_file($stored)) {
            @unlink($stored);
        }
    }
}
