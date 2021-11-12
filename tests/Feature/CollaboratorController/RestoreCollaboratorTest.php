<?php

namespace Tests\Feature\CollaboratorController;

use Tests\TestCase;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestoreCollaboratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_restore_collaborators()
    {
        $this->post(route('collaborators.restore', rand()))->assertRedirect('login');
    }

    /**
     * @test
     */
    public function users_can_restore_collaborators()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw();

        $collaborator = Collaborator::create($attributes);

        $collaborator->delete();
        $this->assertSoftDeleted('collaborators', $attributes);

        $this->post(route('collaborators.restore', $collaborator))
            ->assertRedirect(route('collaborators.index'));

        $this->assertEquals($collaborator->id, Collaborator::first()->id ?? null);
    }
}
