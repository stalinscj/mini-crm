<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function must_save_email_in_lowercase()
    {
        $email = 'CamelEmail@email.COM';

        $company = Company::factory()
            ->create(['email' => $email]);

        $this->assertTrue($company->email == strtolower($email), 'The email is not stored in lowercase');
    }

    /**
     * @test
     */
    public function must_save_website_in_lowercase()
    {
        $website = 'https://CamelSite.com';

        $company = Company::factory()
            ->create(['website' => $website]);

        $this->assertTrue($company->website == strtolower($website), 'The website is not stored in lowercase');
    }

    /**
     * @test
     */
    public function has_many_collaborators()
    {
        $company = Company::factory()
            ->hasCollaborators(2)
            ->create();

        $this->assertInstanceOf(Collaborator::class, $company->collaborators->first());
    }
}
