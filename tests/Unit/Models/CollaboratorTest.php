<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollaboratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function must_save_email_in_lowercase()
    {
        $email = 'CamelEmail@email.COM';

        $collaborator = Collaborator::factory()
            ->create(['email' => $email]);

        $this->assertTrue($collaborator->email == strtolower($email), 'The email is not stored in lowercase');
    }

    /**
     * @test
     */
    public function belongs_to_company()
    {
        $collaborator = Collaborator::factory()->create();

        $this->assertInstanceOf(Company::class, $collaborator->company);
    }
}
