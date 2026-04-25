<?php

namespace Tests\Feature\Admin;

use App\Jobs\SendMail;
use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
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

    public function test_ユーザを新規登録できる_メール送信ジョブが発火する(): void
    {
        Bus::fake();
        $admin = AdminUser::factory()->create();

        $response = $this->actingAs($admin, 'admin')->post(route('user.store'), [
            'name' => '新規ユーザ',
            'email' => 'new-user@example.com',
            'company' => '株式会社サンプル',
            'tel' => '09012345678',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'name' => '新規ユーザ',
            'email' => 'new-user@example.com',
            'company' => '株式会社サンプル',
            'tel' => '09012345678',
        ]);
        Bus::assertDispatched(SendMail::class);
    }

    public function test_ユーザ登録で必須項目が無いとバリデーションエラー(): void
    {
        $admin = AdminUser::factory()->create();

        $response = $this->actingAs($admin, 'admin')
            ->from(route('user.create'))
            ->post(route('user.store'), [
                // name / email / company / tel すべて空
            ]);

        $response->assertRedirect(route('user.create'));
        $response->assertSessionHasErrors(['name', 'email', 'company', 'tel']);
    }

    public function test_ユーザを更新できる(): void
    {
        $admin = AdminUser::factory()->create();
        $user = User::factory()->create([
            'name' => '旧名',
            'email' => 'old@example.com',
        ]);

        $response = $this->actingAs($admin, 'admin')->post(route('user.update', ['id' => $user->id]), [
            'name' => '新名',
            'email' => 'new@example.com',
            'company' => '更新会社',
            'tel' => '08099998888',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => '新名',
            'email' => 'new@example.com',
            'company' => '更新会社',
        ]);
    }

    public function test_未認証時はユーザ一覧にアクセスできない(): void
    {
        $response = $this->get(route('user.list'));
        $response->assertRedirect(route('admin.login'));
    }
}
