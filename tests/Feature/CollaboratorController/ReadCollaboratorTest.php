<?php

namespace Tests\Feature\CollaboratorController;

use Tests\TestCase;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadCollaboratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_read_collaborators()
    {
        $this->get(route('collaborators.index'))->assertRedirect('login');
        $this->get(route('collaborators.show', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_read_the_collaborators_list()
    {
        $this->signIn();

        $collaborators = Collaborator::factory(5)->create();

        $response = $this->get(route('collaborators.index'))
            ->assertSuccessful()
            ->assertViewIs('collaborators.index');

        foreach ($collaborators as $collaborator) {
            $response->assertSeeText($collaborator->company->name)
                ->assertSeeText($collaborator->name)
                ->assertSeeText($collaborator->last_name)
                ->assertSeeText($collaborator->email);
        }
    }

    /**
     * @test
     */
    public function users_can_read_the_collaborator_details()
    {
        $this->signIn();

        $collaborator = Collaborator::factory()->create();

        $this->get(route('collaborators.show', $collaborator))
            ->assertSuccessful()
            ->assertViewIs('collaborators.show')
            ->assertSeeText($collaborator->company->name)
            ->assertSeeText($collaborator->name)
            ->assertSeeText($collaborator->last_name)
            ->assertSeeText($collaborator->email)
            ->assertSeeText($collaborator->phone)
            ->assertSeeText($collaborator->created_at)
            ->assertSeeText($collaborator->updated_at);
    }
}
