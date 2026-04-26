<?php

namespace Tests;

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Inertia の HTML レンダリング (Vite manifest 必要) を回避するため
        // 全リクエストを X-Inertia ヘッダ付き = JSON レスポンスとして扱う
        $this->withHeaders(['X-Inertia' => 'true']);

        // テスト中は CSRF 検証を無効化（フォーム送信テストの簡略化のため）
        $this->withoutMiddleware(VerifyCsrfToken::class);
    }
}
