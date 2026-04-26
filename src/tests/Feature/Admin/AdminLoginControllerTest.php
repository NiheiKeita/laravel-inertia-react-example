<?php

namespace Tests\Feature\Admin;

use App\Models\AdminUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_管理者ログイン画面が表示される(): void
    {
        $response = $this->get(route('admin.login'));
        $response->assertOk();
    }

    public function test_正しい認証情報で管理者ログインできる(): void
    {
        $admin = AdminUser::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post(route('admin.login'), [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($admin, 'admin');
        $response->assertRedirect();
    }

    public function test_間違ったパスワードでは管理者ログインできない(): void
    {
        $admin = AdminUser::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->from(route('admin.login'))->post(route('admin.login'), [
            'email' => $admin->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest('admin');
        $response->assertRedirect(route('admin.login'));
    }
}
