<?php

namespace Tests\Feature\UserController;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_create_users()
    {
        $this->get(route('users.create'))->assertRedirect('login');
        $this->post(route('users.store'))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_create_users()
    {
        $this->signIn();
        
        $this->get(route('users.create'))
            ->assertSuccessful()
            ->assertViewIs('users.create');

        $attributes = User::factory()->raw([
            'password'              => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->post(route('users.store'), $attributes)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseCount('users', 2);

        $this->assertDatabaseHas('users', Arr::only($attributes, ['name', 'email']));

        $this->assertTrue(Hash::check($attributes['password'], User::first()->password));
    }
}
