<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesUsers;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    public function test_admin_can_view_users_page(): void
    {
        $this->actingAs($this->createAdmin())
            ->get('/users')
            ->assertOk();
    }

    public function test_regular_user_cannot_access_users(): void
    {
        $this->actingAs($this->createUser())
            ->get('/users')
            ->assertForbidden();
    }

    public function test_admin_can_create_user(): void
    {
        $this->actingAs($this->createAdmin())
            ->postJson('/users', [
                'name' => 'Nuevo',
                'lastName' => 'Usuario',
                'email' => 'nuevo@test.com',
                'password' => 'password123',
                'role' => 'user',
            ])
            ->assertOk()
            ->assertJson(['result' => true]);

        $this->assertDatabaseHas('users', ['email' => 'nuevo@test.com']);
    }

    public function test_admin_can_update_user(): void
    {
        $user = $this->createUser();

        $this->actingAs($this->createAdmin())
            ->putJson("/users/{$user->id}", [
                'name' => 'Modificado',
                'lastName' => 'Apellido',
                'email' => $user->email,
                'role' => 'user',
            ])
            ->assertOk();

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Modificado']);
    }

    public function test_admin_can_delete_other_user(): void
    {
        $user = $this->createUser();

        $this->actingAs($this->createAdmin())
            ->deleteJson("/users/{$user->id}")
            ->assertOk();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_cannot_delete_self(): void
    {
        $admin = $this->createAdmin();

        $this->actingAs($admin)
            ->deleteJson("/users/{$admin->id}")
            ->assertStatus(422);
    }
}
