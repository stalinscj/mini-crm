<?php

namespace Tests\Feature\CompanyController;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidateCompanyFieldsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function the_name_field_is_required_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['name' => '']);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.required', ['attribute' => 'nombre'])
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');
        
        $company = Company::factory()->create();

        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.required', ['attribute' => 'nombre'])
        );
    }

    /**
     * @test
     */
    public function the_name_field_must_be_a_string_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['name' => 123456]);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.string', ['attribute' => 'nombre'])
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');

        $company = Company::factory()->create();

        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.string', ['attribute' => 'nombre'])
        );
    }

    /**
     * @test
     */
    public function the_name_field_must_not_be_greater_than_60_chars_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['name' => Str::random(61)]);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.max.string', ['attribute' => 'nombre', 'max' => 60])
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');

        $company = Company::factory()->create();

        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.max.string', ['attribute' => 'nombre', 'max' => 60])
        );
    }

    /**
     * @test
     */
    public function the_name_field_must_be_unique_to_create_and_update_a_company()
    {
        $this->signIn();

        $company = Company::factory()->create();

        $attributes = Company::factory()->raw(['name' => $company->name]);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.unique', ['attribute' => 'nombre'])
        );

        $this->assertDatabaseCount('companies', 1);

        session()->forget('errors');

        $companyB = Company::factory()->create();

        $this->put(route('companies.update', $companyB), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'name',
            trans('validation.unique', ['attribute' => 'nombre'])
        );
    }

    /**
     * @test
     */
    public function the_email_field_is_required_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['email' => '']);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.required', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');

        $company = Company::factory()->create();
        
        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.required', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_be_a_string_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['email' => 123456]);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.string', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');

        $company = Company::factory()->create();

        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.string', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_not_be_greater_than_100_chars_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['email' => Str::random(101)]);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.max.string', ['attribute' => 'email', 'max' => 100]),
            1
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');

        $company = Company::factory()->create();

        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.max.string', ['attribute' => 'email', 'max' => 100]),
            1
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_be_a_valid_email_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['email' => 'invalid@email']);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.email', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');

        $company = Company::factory()->create();

        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.email', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_email_field_must_be_unique_to_create_and_update_a_company()
    {
        $this->signIn();

        $company = Company::factory()->create();

        $attributes = Company::factory()->raw(['email' => $company->email]);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.unique', ['attribute' => 'email'])
        );

        $this->assertDatabaseCount('companies', 1);

        session()->forget('errors');

        $companyB = Company::factory()->create();

        $this->put(route('companies.update', $companyB), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'email',
            trans('validation.unique', ['attribute' => 'email'])
        );
    }

    /**
     * @test
     */
    public function the_website_field_is_required_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['website' => '']);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'website',
            trans('validation.required', ['attribute' => 'sitio web'])
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');

        $company = Company::factory()->create();
        
        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'website',
            trans('validation.required', ['attribute' => 'sitio web'])
        );
    }

    /**
     * @test
     */
    public function the_website_field_must_be_a_string_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['website' => 123456]);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'website',
            trans('validation.string', ['attribute' => 'sitio web'])
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');

        $company = Company::factory()->create();

        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'website',
            trans('validation.string', ['attribute' => 'sitio web'])
        );
    }

    /**
     * @test
     */
    public function the_website_field_must_not_be_greater_than_100_chars_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['website' => Str::random(101)]);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'website',
            trans('validation.max.string', ['attribute' => 'sitio web', 'max' => 100]),
            1
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');

        $company = Company::factory()->create();

        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'website',
            trans('validation.max.string', ['attribute' => 'sitio web', 'max' => 100]),
            1
        );
    }

    /**
     * @test
     */
    public function the_website_field_must_be_a_valid_url_to_create_and_update_a_company()
    {
        $this->signIn();

        $attributes = Company::factory()->raw(['website' => 'invalid url']);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'website',
            trans('validation.url', ['attribute' => 'sitio web'])
        );

        $this->assertDatabaseCount('companies', 0);

        session()->forget('errors');

        $company = Company::factory()->create();

        $this->put(route('companies.update', $company), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'website',
            trans('validation.url', ['attribute' => 'sitio web'])
        );
    }

    /**
     * @test
     */
    public function the_website_field_must_be_unique_to_create_and_update_a_company()
    {
        $this->signIn();

        $company = Company::factory()->create();

        $attributes = Company::factory()->raw(['website' => $company->website]);

        $this->post(route('companies.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'website',
            trans('validation.unique', ['attribute' => 'sitio web'])
        );

        $this->assertDatabaseCount('companies', 1);

        session()->forget('errors');

        $companyB = Company::factory()->create();

        $this->put(route('companies.update', $companyB), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'website',
            trans('validation.unique', ['attribute' => 'sitio web'])
        );
    }
}
