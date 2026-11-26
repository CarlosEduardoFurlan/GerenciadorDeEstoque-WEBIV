<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_and_returns_to_requested_list(): void
    {
        $this->get('/formas-pagamento')->assertRedirect(route('login'));

        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect('/formas-pagamento');
    }

    public function test_home_and_existing_write_routes_require_login(): void
    {
        $this->get('/')->assertRedirect(route('login'));
        $this->post('/formas-pagamento', [])->assertRedirect(route('login'));
        $this->post('/fornecedor/salvar', [])->assertRedirect(route('login'));
    }

    public function test_public_registration_rejects_repeated_email_and_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->from('/register')->post('/register', [
            'name' => 'Outra pessoa',
            'email' => $user->email,
            'password' => 'secret123',
            'password_confirmation' => 'different',
        ])->assertRedirect('/register')->assertSessionHasErrors(['email', 'password']);

        $this->assertDatabaseCount('users', 1);
        $this->assertGuest();
    }
}
