<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserRoleTest extends TestCase
{
    public function test_is_admin_helper(): void
    {
        $admin = new User(['role' => 'admin']);
        $user = new User(['role' => 'user']);
        $legacy = new User;

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($user->isAdmin());
        $this->assertFalse($legacy->isAdmin());
    }
}
