<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function must_save_email_in_lowercase()
    {
        $email = 'CamelEmail@email.COM';

        $user = User::factory()
            ->create(['email' => $email]);

        $this->assertTrue($user->email == strtolower($email), 'The email is not stored in lowercase');
    }
}
