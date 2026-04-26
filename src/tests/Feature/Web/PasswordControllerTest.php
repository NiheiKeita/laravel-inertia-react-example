<?php

namespace Tests\Feature\Web;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_未認証時はパスワード編集画面にアクセスできない(): void
    {
        $response = $this->get(route('web.password.edit', ['token' => 'any-token']));
        $response->assertRedirect(route('user.login'));
    }

    public function test_認証済みユーザはパスワード編集画面を表示できる(): void
    {
        $user = User::factory()->create([
            'password_token' => 'sample-token',
        ]);

        $response = $this->actingAs($user, 'web')->get(route('web.password.edit', ['token' => 'sample-token']));

        $response->assertOk();
    }

    public function test_パスワード更新でハッシュ化_トークンクリア_フラグ更新される(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
            'password_token' => 'sample-token',
            'password_updated' => false,
        ]);

        $response = $this->actingAs($user, 'web')->post(
            route('web.password.update', ['token' => 'sample-token']),
            [
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]
        );

        $response->assertRedirect();

        $fresh = $user->fresh();
        $this->assertTrue(Hash::check('new-password', $fresh->password));
        $this->assertNull($fresh->password_token);
        $this->assertTrue((bool) $fresh->password_updated);
    }

    public function test_パスワード更新でconfirmationが一致しないとバリデーションエラー(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->from(route('web.password.edit', ['token' => 'tok']))
            ->post(route('web.password.update', ['token' => 'tok']), [
                'password' => 'new-password',
                'password_confirmation' => 'different-password',
            ]);

        $response->assertSessionHasErrors('password_confirmation');
    }
}
