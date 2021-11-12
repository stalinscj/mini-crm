<?php

namespace Tests\Feature\CollaboratorController;

use Tests\TestCase;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCollaboratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_update_collaborators()
    {
        $this->get(route('collaborators.edit', rand()))->assertRedirect('login');
        $this->put(route('collaborators.update', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_update_collaborators()
    {
        $this->signIn();

        $collaborator = Collaborator::factory()->create();
        
        $this->get(route('collaborators.edit', $collaborator))
            ->assertSuccessful()
            ->assertViewIs('collaborators.edit');

        $attributes = Collaborator::factory()->raw();

        $this->put(route('collaborators.update', $collaborator), $attributes)
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseCount('collaborators', 1);

        $this->assertDatabaseHas('collaborators', $attributes);
    }
}
