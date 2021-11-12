<?php

namespace Tests\Feature\UserController;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_delete_users()
    {
        $this->delete(route('users.destroy', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_delete_users()
    {
        $this->signIn();

        $user = User::factory()->create();
        
        $this->delete(route('users.destroy', $user))
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /**
     * @test
     */
    public function users_cannot_delete_themselves()
    {
        $user = $this->signIn();

        $this->delete(route('users.destroy', $user))
            ->assertForbidden();

        $this->assertDatabaseCount('users', 1);
    }
}
