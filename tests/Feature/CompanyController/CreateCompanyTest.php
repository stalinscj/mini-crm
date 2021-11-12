<?php

namespace Tests\Feature\CompanyController;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_create_companies()
    {
        $this->get(route('companies.create'))->assertRedirect('login');
        $this->post(route('companies.store'))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_create_companies()
    {
        $this->signIn();
        
        $this->get(route('companies.create'))
            ->assertSuccessful()
            ->assertViewIs('companies.create');

        $attributes = Company::factory()->raw();

        $this->post(route('companies.store'), $attributes)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('companies.index'));

        $this->assertDatabaseCount('companies', 1);

        $this->assertDatabaseHas('companies', $attributes);
    }
}
