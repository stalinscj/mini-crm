<?php

namespace Tests\Feature\UserController;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_read_users()
    {
        $this->get(route('users.index'))->assertRedirect('login');
        $this->get(route('users.show', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_read_the_users_list()
    {
        $users = User::factory(5)->create();

        $this->signIn();

        $response = $this->get(route('users.index'))
            ->assertSuccessful()
            ->assertViewIs('users.index');

        foreach ($users as $user) {
            $response->assertSeeText($user->name)
                ->assertSeeText($user->email)
                ->assertSeeText($user->created_at);
        }
    }

    /**
     * @test
     */
    public function users_can_read_the_user_details()
    {
        $this->signIn();

        $user = User::factory()->create();

        $this->get(route('users.show', $user))
            ->assertSuccessful()
            ->assertViewIs('users.show')
            ->assertSeeText($user->name)
            ->assertSeeText($user->email)
            ->assertSeeText($user->created_at)
            ->assertSeeText($user->updated_at);
    }
}
