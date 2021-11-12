<?php

namespace Tests\Feature\CollaboratorController;

use Tests\TestCase;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCollaboratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_create_collaborators()
    {
        $this->get(route('collaborators.create'))->assertRedirect('login');
        $this->post(route('collaborators.store'))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_create_collaborators()
    {
        $this->signIn();
        
        $this->get(route('collaborators.create'))
            ->assertSuccessful()
            ->assertViewIs('collaborators.create');

        $attributes = Collaborator::factory()->raw();

        $this->post(route('collaborators.store'), $attributes)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('collaborators.index'));

        $this->assertDatabaseCount('collaborators', 1);

        $this->assertDatabaseHas('collaborators', $attributes);
    }
}
