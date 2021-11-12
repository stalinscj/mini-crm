<?php

namespace Tests\Feature\UserController;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_update_users()
    {
        $this->get(route('users.edit', rand()))->assertRedirect('login');
        $this->put(route('users.update', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_update_users()
    {
        $this->signIn();

        $user = User::factory()->create();
        
        $this->get(route('users.edit', $user))
            ->assertSuccessful()
            ->assertViewIs('users.edit');

        $attributes = User::factory()->raw();

        $this->put(route('users.update', $user), $attributes)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseCount('users', 2);

        $this->assertDatabaseHas('users', Arr::only($attributes, ['name', 'email']));
    }
}
