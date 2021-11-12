<?php

namespace Tests\Feature\CompanyController;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadCompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_read_companies()
    {
        $this->get(route('companies.index'))->assertRedirect('login');
        $this->get(route('companies.show', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_read_the_companies_list()
    {
        $this->signIn();

        $companies = Company::factory(5)->create();

        $response = $this->get(route('companies.index'))
            ->assertSuccessful()
            ->assertViewIs('companies.index');

        foreach ($companies as $company) {
            $response->assertSeeText($company->name)
                ->assertSeeText($company->email)
                ->assertSeeText($company->website);
        }
    }

    /**
     * @test
     */
    public function users_can_read_the_company_details()
    {
        $this->signIn();

        $company = Company::factory()->create();

        $this->get(route('companies.show', $company))
            ->assertSuccessful()
            ->assertViewIs('companies.show')
            ->assertSeeText($company->name)
            ->assertSeeText($company->email)
            ->assertSeeText($company->website)
            ->assertSeeText($company->created_at)
            ->assertSeeText($company->updated_at);
    }
}
