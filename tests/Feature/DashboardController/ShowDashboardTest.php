<?php

namespace Tests\Feature\DashboardController;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
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

        User::factory()->create();
        Company::factory(3)
            ->hasCollaborators(2)
            ->create();

        $this->get(route('dashboard'))
            ->assertSuccessful()
            ->assertViewIs('dashboard.index')
            ->assertSeeTextInOrder([
                2,
                'Usuarios registrados',
                3,
                'Empresas registradas',
                6,
                'Colaboradores registrados'
            ]);
    }
}
