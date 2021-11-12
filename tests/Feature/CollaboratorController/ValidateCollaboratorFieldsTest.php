<?php

namespace Tests\Feature\CollaboratorController;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidateCollaboratorFieldsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function the_name_field_is_required_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['name' => '']);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.required', ['attribute' => 'name'])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');
        
        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.required', ['attribute' => 'name'])
        );
    }

    /**
     * @test
     */
    public function the_name_field_must_be_a_string_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['name' => 123456]);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.string', ['attribute' => 'name'])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.string', ['attribute' => 'name'])
        );
    }

    /**
     * @test
     */
    public function the_name_field_must_not_be_greater_than_60_chars_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['name' => Str::random(61)]);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.max.string', ['attribute' => 'name', 'max' => 60])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.max.string', ['attribute' => 'name', 'max' => 60])
        );
    }

    /**
     * @test
     */
    public function the_last_name_field_is_required_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['last_name' => '']);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'last_name',
            trans('validation.required', ['attribute' => 'last name'])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');
        
        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'last_name',
            trans('validation.required', ['attribute' => 'last name'])
        );
    }

    /**
     * @test
     */
    public function the_last_name_field_must_be_a_string_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['last_name' => 123456]);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'last_name',
            trans('validation.string', ['attribute' => 'last name'])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'last_name',
            trans('validation.string', ['attribute' => 'last name'])
        );
    }

    /**
     * @test
     */
    public function the_last_name_field_must_not_be_greater_than_60_chars_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['last_name' => Str::random(61)]);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'last_name',
            trans('validation.max.string', ['attribute' => 'last name', 'max' => 60])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'last_name',
            trans('validation.max.string', ['attribute' => 'last name', 'max' => 60])
        );
    }

    /**
     * @test
     */
    public function the_email_field_is_required_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['email' => '']);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.required', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();
        
        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.required', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_be_a_string_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['email' => 123456]);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.string', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.string', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_not_be_greater_than_100_chars_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['email' => Str::random(101)]);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.max.string', ['attribute' => 'email', 'max' => 100]),
            1
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.max.string', ['attribute' => 'email', 'max' => 100]),
            1
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_be_a_valid_email_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['email' => 'invalid@email']);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.email', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.email', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_be_unique_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $collaborator = Collaborator::factory()->create();

        $attributes = Collaborator::factory()->raw(['email' => $collaborator->email]);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.unique', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('collaborators', 1);

        session()->forget('errors');

        $collaboratorB = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaboratorB), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.unique', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_phone_field_is_required_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['phone' => '']);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'phone',
            trans('validation.required', ['attribute' => 'phone'])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();
        
        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'phone',
            trans('validation.required', ['attribute' => 'phone'])
        );
    }

    /**
     * @test
     */
    public function the_phone_field_must_be_a_string_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['phone' => true]);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'phone',
            trans('validation.string', ['attribute' => 'phone'])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'phone',
            trans('validation.string', ['attribute' => 'phone'])
        );
    }

    /**
     * @test
     */
    public function the_phone_field_must_be_exact_9_digits_to_create_and_update_a_collaborator()
    {
        $this->signIn();

        $attributes = Collaborator::factory()->raw(['phone' => $this->faker->numerify('########')]);

        $this->post(route('collaborators.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'phone',
            trans('validation.digits', ['attribute' => 'phone', 'digits' => 9])
        );

        $this->assertDatabaseCount('collaborators', 0);

        session()->forget('errors');

        $collaborator = Collaborator::factory()->create();

        $this->put(route('collaborators.update', $collaborator), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'phone',
            trans('validation.digits', ['attribute' => 'phone', 'digits' => 9])
        );
    }
}
