<?php

namespace Tests\Feature\Admin;

use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\Feature\Security\CreatesDomainData;
use Tests\TestCase;

class SiteImagesTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_non_admin_cannot_manage_site_images(): void
    {
        $this->actingAs($this->makeUser())->get('/admin/site-images')->assertRedirect('/');
    }

    public function test_admin_can_upload_a_valid_image(): void
    {
        $admin = $this->makeAdmin();
        $file = UploadedFile::fake()->image('hero.jpg', 900, 500);

        $this->actingAs($admin)->post('/admin/site-images', ['home_hero_image' => $file])
            ->assertRedirect();

        $value = SiteSetting::get('home_hero_image');
        $this->assertNotNull($value);
        $this->assertStringStartsWith('upload/site/', $value);
        $this->assertStringNotContainsString('hero.jpg', $value); // server-generated name

        // cleanup the file written to public/
        $stored = public_path($value);
        if (is_file($stored)) {
            @unlink($stored);
        }
    }

    public function test_dangerous_file_is_rejected(): void
    {
        $admin = $this->makeAdmin();
        $file = UploadedFile::fake()->create('evil.php', 10, 'application/x-php');

        $this->actingAs($admin)
            ->from('/admin/site-images')
            ->post('/admin/site-images', ['home_hero_image' => $file])
            ->assertSessionHasErrors('home_hero_image');

        $this->assertNull(SiteSetting::get('home_hero_image'));
    }

    public function test_oversized_image_is_rejected(): void
    {
        $admin = $this->makeAdmin();
        $file = UploadedFile::fake()->image('big.jpg')->size(5000); // 5 MB > 4 MB

        $this->actingAs($admin)
            ->from('/admin/site-images')
            ->post('/admin/site-images', ['home_hero_image' => $file])
            ->assertSessionHasErrors('home_hero_image');
    }

    public function test_default_image_used_when_none_configured(): void
    {
        $this->assertSame(asset('images/slider2.png'), SiteSetting::image('home_hero_image', 'images/slider2.png'));
    }
}
