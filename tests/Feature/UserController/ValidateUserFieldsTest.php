<?php

namespace Tests\Feature\UserController;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidateUserFieldsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function the_name_field_is_required_to_create_and_update_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['name' => '']);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.required', ['attribute' => 'nombre'])
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.required', ['attribute' => 'nombre'])
        );
    }

    /**
     * @test
     */
    public function the_name_field_must_be_a_string_to_create_and_update_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['name' => 123456]);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.string', ['attribute' => 'nombre'])
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.string', ['attribute' => 'nombre'])
        );
    }

    /**
     * @test
     */
    public function the_name_field_must_not_be_greater_than_60_chars_to_create_and_update_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['name' => Str::random(61)]);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.max.string', ['attribute' => 'nombre', 'max' => 60])
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.max.string', ['attribute' => 'nombre', 'max' => 60])
        );
    }

    /**
     * @test
     */
    public function the_email_field_is_required_to_create_and_update_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['email' => '']);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.required', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();
        
        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.required', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_be_a_string_to_create_and_update_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['email' => 123456]);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.string', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.string', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_not_be_greater_than_100_chars_to_create_and_update_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['email' => Str::random(101)]);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.max.string', ['attribute' => 'email', 'max' => 100]),
            1
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.max.string', ['attribute' => 'email', 'max' => 100]),
            1
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_be_a_valid_email_to_create_and_update_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['email' => 'invalid@email']);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.email', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.email', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_be_unique_to_create_and_update_a_user()
    {
        $user = $this->signIn();

        $attributes = User::factory()->raw(['email' => $user->email]);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.unique', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.unique', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_password_field_is_required_to_create_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['password' => '']);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'password',
            trans('validation.required', ['attribute' => 'contraseña'])
        );

        $this->assertDatabaseCount('users', 1);
    }

    /**
     * @test
     */
    public function the_password_field_is_required_to_update_a_user_only_if_update_password_is_sent()
    {
        $this->signIn();

        $user = User::factory()->create();

        $attributes = User::factory()->raw(['password' => '', 'update_password' => true]);

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'password',
            trans('validation.required', ['attribute' => 'contraseña'])
        );

        session()->forget('errors');

        $attributes = User::factory()->raw(['password' => '']);

        $this->put(route('users.update', $user), $attributes)
            ->assertSessionDoesntHaveErrors('password');

    }

    /**
     * @test
     */
    public function the_password_field_must_be_a_string_to_create_and_update_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['password' => 123456]);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'password',
            trans('validation.string', ['attribute' => 'contraseña'])
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();

        $attributes['update_password'] = true;

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'password',
            trans('validation.string', ['attribute' => 'contraseña'])
        );
    }

    /**
     * @test
     */
    public function the_password_field_must_not_be_less_than_8_chars_to_create_and_update_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['password' => Str::random(7)]);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'password',
            trans('validation.min.string', ['attribute' => 'contraseña', 'min' => 8])
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();

        $attributes['update_password'] = true;

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'password',
            trans('validation.min.string', ['attribute' => 'contraseña', 'min' => 8])
        );
    }

    /**
     * @test
     */
    public function the_password_field_must_be_a_confirmed_to_create_and_update_a_user()
    {
        $this->signIn();

        $attributes = User::factory()->raw(['password' => 'password']);

        $this->post(route('users.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'password',
            trans('validation.confirmed', ['attribute' => 'contraseña'])
        );

        $this->assertDatabaseCount('users', 1);

        session()->forget('errors');

        $user = User::factory()->create();

        $attributes['update_password'] = true;

        $this->put(route('users.update', $user), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'password',
            trans('validation.confirmed', ['attribute' => 'contraseña'])
        );
    }
}
