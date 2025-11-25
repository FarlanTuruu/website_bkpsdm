<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnnouncementStoreTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsAdmin()
    {
        $user = User::factory()->create(); 
        $this->actingAs($user);
    }

    /** @test */
    public function store_success_without_publish_date()
    {
        $this->actingAsAdmin();

        $response = $this->post('/admin/announcements', [
            'title' => 'Test Announcement',
            'content' => 'Test content',
            'status' => 'published',
        ]);

        $response->assertRedirect('/admin/announcements');

        $this->assertDatabaseHas('announcements', [
            'title' => 'Test Announcement',
            'content' => 'Test content',
            'status' => 'published',
        ]);
    }

    /** @test */
    public function store_success_with_valid_publish_date()
    {
        $this->actingAsAdmin();

        $response = $this->post('/admin/announcements', [
            'title' => 'Test',
            'content' => 'Content',
            'status' => 'draft',
            'publish_date' => now()->addDays(5)->format('d-m-Y'),
        ]);

        $response->assertRedirect('/admin/announcements');
        $this->assertDatabaseCount('announcements', 1);
    }

    /** @test */
    public function store_fails_with_invalid_date_format()
    {
        $this->actingAsAdmin();

        $response = $this->post('/admin/announcements', [
            'title' => 'Test',
            'content' => 'Test',
            'status' => 'draft',
            'publish_date' => '2025/01/01',
        ]);

        $response->assertSessionHasErrors('publish_date');
    }

    /** @test */
    public function store_fails_with_past_date()
    {
        $this->actingAsAdmin();

        $yesterday = now()->subDay()->format('d-m-Y');

        $response = $this->post('/admin/announcements', [
            'title' => 'Test Past Date',
            'content' => 'Test',
            'status' => 'published',
            'publish_date' => $yesterday,
        ]);

        $response->assertSessionHasErrors('publish_date');
    }

    /** @test */
    public function store_fails_when_date_exceeds_one_year_limit()
    {
        $this->actingAsAdmin();

        $too_far = now()->addYears(2)->format('d-m-Y');

        $response = $this->post('/admin/announcements', [
            'title' => 'Test Max Date',
            'content' => 'Test Content',
            'status' => 'draft',
            'publish_date' => $too_far,
        ]);

        $response->assertSessionHasErrors('publish_date');
    }

    /** @test */
    public function store_success_with_valid_image_upload()
    {
        $this->actingAsAdmin();
        Storage::fake('public');

        $file = UploadedFile::fake()->image('banner.jpg');

        $response = $this->post('/admin/announcements', [
            'title' => 'Test Image',
            'content' => 'Testing image',
            'status' => 'draft',
            'image' => $file,
        ]);

        $response->assertRedirect('/admin/announcements');
        Storage::disk('public')->assertExists('announcements/' . $file->hashName());
    }

    /** @test */
    public function store_fails_when_image_is_not_valid()
    {
        $this->actingAsAdmin();
        Storage::fake('public');

        $file = UploadedFile::fake()->create('file.pdf', 100);

        $response = $this->post('/admin/announcements', [
            'title' => 'Invalid Image',
            'content' => 'Test',
            'status' => 'draft',
            'image' => $file,
        ]);

        $response->assertSessionHasErrors('image');
    }
}
