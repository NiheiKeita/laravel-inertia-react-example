<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_画像をアップロードして保存できる(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('photo.png', 100, 100);

        $response = $this->postJson(route('upload'), [
            'image' => $file,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['url', 'id']);
        $this->assertDatabaseCount('images', 1);
    }

    public function test_画像以外のファイルはバリデーションで拒否される(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('document.txt', 10);

        $response = $this->postJson(route('upload'), [
            'image' => $file,
        ]);

        $response->assertStatus(422);
        $this->assertDatabaseCount('images', 0);
    }

    public function test_2MBを超える画像は拒否される(): void
    {
        Storage::fake('public');

        // 3MB のダミー画像（バリデーション max:2048KB を超える）
        $file = UploadedFile::fake()->image('huge.png')->size(3000);

        $response = $this->postJson(route('upload'), [
            'image' => $file,
        ]);

        $response->assertStatus(422);
        $this->assertDatabaseCount('images', 0);
    }
}
