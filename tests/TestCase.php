<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Returns a User after sign in
     *
     * @param  \App\Models\User|null $user
     * @return \App\Models\User
     */
    protected function signIn(User $user = null)
    {
        $user = $user ?: User::factory()->create();

        $this->actingAs($user);

        return $user;
    }

    /**
     * Assert that the session has the given error key-value.
     *
     * @param string $key
     * @param string $value
     * @param int    $index
     * 
     * @return $this
     */
    protected function assertSessionHasErrorKeyValue($key, $value, $index = 0)
    {
        $errors = session('errors');

        $error = optional($errors)->get($key)[$index] ?? '';

        $this->assertEquals($value, $error, "Session missing error: '$key' with '$value' at index $index");

        return $this;
    }
}
