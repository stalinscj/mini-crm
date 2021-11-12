<?php

namespace Tests\Feature\CompanyController;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_update_companies()
    {
        $this->get(route('companies.edit', rand()))->assertRedirect('login');
        $this->put(route('companies.update', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_update_companies()
    {
        $this->signIn();

        $company = Company::factory()->create();
        
        $this->get(route('companies.edit', $company))
            ->assertSuccessful()
            ->assertViewIs('companies.edit');

        $attributes = Company::factory()->raw();

        $this->put(route('companies.update', $company), $attributes)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseCount('companies', 1);

        $this->assertDatabaseHas('companies', $attributes);
    }
}
