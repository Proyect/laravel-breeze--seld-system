<?php

namespace Tests;

use App\Models\User;

trait CreatesUsers
{
    protected function createAdmin(): User
    {
        return User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'role' => 'admin',
        ]);
    }

    protected function createUser(): User
    {
        return User::factory()->create([
            'name' => 'Usuario',
            'email' => 'user@test.com',
            'role' => 'user',
        ]);
    }
}
