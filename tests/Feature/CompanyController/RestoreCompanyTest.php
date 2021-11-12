<?php

namespace Tests\Feature\CompanyController;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestoreCompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_restore_companies()
    {
        $this->post(route('companies.restore', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_restore_companies()
    {
        $this->signIn();

        $attributes = Company::factory()->raw();

        $company = Company::create($attributes);

        $company->delete();
        $this->assertSoftDeleted('companies', $attributes);

        $this->post(route('companies.restore', $company))
            ->assertRedirect(route('companies.index'));

        $this->assertEquals($company->id, Company::first()->id ?? null);
    }
}
