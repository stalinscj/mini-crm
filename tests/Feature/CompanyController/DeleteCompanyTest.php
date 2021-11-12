<?php

namespace Tests\Feature\CompanyController;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteCompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_delete_companies()
    {
        $this->delete(route('companies.destroy', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_delete_companies()
    {
        $this->signIn();

        $company = Company::factory()->create();
        
        $this->delete(route('companies.destroy', $company))
            ->assertRedirect(route('companies.index'));

        $this->assertDatabaseCount('companies', 0);
    }
}
