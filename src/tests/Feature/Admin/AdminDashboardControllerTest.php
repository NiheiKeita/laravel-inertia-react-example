<?php

namespace Tests\Feature\Admin;

use App\Models\AdminUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_未認証時はログイン画面にリダイレクトされる(): void
    {
        $response = $this->get(route('admin.dashboard.index'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_認証済み管理者はダッシュボードを閲覧できる(): void
    {
        $admin = AdminUser::factory()->create();

        $response = $this->actingAs($admin, 'admin')->get(route('admin.dashboard.index'));
        $response->assertOk();
    }
}
