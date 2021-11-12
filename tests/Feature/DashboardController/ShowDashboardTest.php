<?php

namespace Tests\Feature\DashboardController;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowDashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_access_to_dashboard()
    {
        $this->get(route('dashboard'))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_see_the_dashboard()
    {
        $this->signIn();

        $this->get(route('dashboard'))
            ->assertSuccessful()
            ->assertViewIs('dashboard.index');
    }
}
