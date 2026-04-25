<?php

namespace Tests\Feature\Admin;

use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ユーザ一覧が表示される(): void
    {
        $admin = AdminUser::factory()->create();
        User::factory()->count(3)->create();

        $response = $this->actingAs($admin, 'admin')->get(route('user.list'));

        $response->assertOk();
    }

    public function test_ユーザ作成フォームが表示される(): void
    {
        $admin = AdminUser::factory()->create();

        $response = $this->actingAs($admin, 'admin')->get(route('user.create'));

        $response->assertOk();
    }

    public function test_ユーザ編集画面が表示される(): void
    {
        $admin = AdminUser::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin, 'admin')->get(route('user.edit', ['id' => $user->id]));

        $response->assertOk();
    }

    public function test_未認証時はユーザ一覧にアクセスできない(): void
    {
        $response = $this->get(route('user.list'));
        $response->assertRedirect(route('admin.login'));
    }
}
