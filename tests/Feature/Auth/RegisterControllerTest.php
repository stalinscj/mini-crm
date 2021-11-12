<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Support\Facades\Route;

class RegisterControllerTest extends TestCase
{
    /**
     * @test
     */
    public function guests_cannot_register()
    {
        $registerRoute = Route::getRoutes()->getByName('register');

        $this->assertNull($registerRoute);

        $this->get('/register')->assertStatus(404);
        $this->post('/register')->assertStatus(404);
    }
}
