<?php

namespace Tests\Feature\UserController;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestoreUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_restore_users()
    {
        $this->post(route('users.restore', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_restore_users()
    {
        $this->signIn();

        $user = User::factory()->create();

        $user->delete();
        $this->assertSoftDeleted('users',  ['id' => $user->id]);

        $this->post(route('users.restore', $user))
            ->assertRedirect(route('users.index'));;

        $this->assertEquals($user->id, User::find($user->id)->id ?? null);
    }
}
