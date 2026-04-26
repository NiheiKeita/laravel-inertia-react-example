<?php

namespace Tests\Feature\Admin;

use App\Models\AdminUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_管理者ユーザ一覧が表示される(): void
    {
        $admin = AdminUser::factory()->create();
        AdminUser::factory()->count(3)->create();

        $response = $this->actingAs($admin, 'admin')->get(route('admin_user.list'));

        $response->assertOk();
    }

    public function test_管理者ユーザ作成フォームが表示される(): void
    {
        $admin = AdminUser::factory()->create();

        $response = $this->actingAs($admin, 'admin')->get(route('admin_user.create'));

        $response->assertOk();
    }

    public function test_管理者ユーザを新規登録できる(): void
    {
        $admin = AdminUser::factory()->create();

        $response = $this->actingAs($admin, 'admin')->post(route('admin_user.store'), [
            'name' => 'New Admin',
            'email' => 'new-admin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('admin_users', [
            'name' => 'New Admin',
            'email' => 'new-admin@example.com',
        ]);
    }

    public function test_未認証時は管理者ユーザ一覧にアクセスできない(): void
    {
        $response = $this->get(route('admin_user.list'));
        $response->assertRedirect(route('admin.login'));
    }
}
