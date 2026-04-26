<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class TopControllerTest extends TestCase
{
    public function test_トップページが表示される(): void
    {
        $response = $this->get(route('web.top'));
        $response->assertOk();
    }

    public function test_存在しないURLはトップページにリダイレクトされる(): void
    {
        $response = $this->get('/some-undefined-path-' . uniqid());
        $response->assertRedirect(route('web.top'));
    }
}
