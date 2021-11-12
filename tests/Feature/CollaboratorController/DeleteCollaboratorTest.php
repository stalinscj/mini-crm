<?php

namespace Tests\Feature\CollaboratorController;

use Tests\TestCase;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteCollaboratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_delete_collaborators()
    {
        $this->delete(route('collaborators.destroy', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_delete_collaborators()
    {
        $this->signIn();

        $collaborator = Collaborator::factory()->create();
        
        $this->delete(route('collaborators.destroy', $collaborator))
            ->assertRedirect(route('collaborators.index'));

        $this->assertDatabaseCount('collaborators', 0);
    }
}
