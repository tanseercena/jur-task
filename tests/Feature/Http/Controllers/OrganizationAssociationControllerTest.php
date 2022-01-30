<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganizationAssociationControllerTest extends TestCase
{
    use WithFaker;

    /**
     * User can create an organization association test.
     *
     * @return void
     */
    public function test_user_can_create_organization_association()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('user.org.association.store'), [
            'name' => 'Test Company',
            'associated_as' => 'Developer',
            'start_date' => date("Y-m-d", strtotime("2020-02-15")),
            'end_date' => date("Y-m-d", strtotime("2021-01-15")),
            'description' => 'Testing Descriptions',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('dashboard');
        $this->followRedirects($response)->assertSee('Organization Association added successfully!');
    }

    /**
     * User can't create organization association if description greater than 100 words.
     *
     * @return void
     */
    public function test_user_cant_create_organization_association_if_description_greater_than_100_words()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('user.org.association.store'), [
            'name' => 'Test Company',
            'associated_as' => 'Developer',
            'start_date' => date("Y-m-d", strtotime("2020-02-15")),
            'end_date' => date("Y-m-d", strtotime("2021-01-15")),
            'description' => $this->faker->sentence(200),
        ]);

        $response->assertSessionHasErrors(['description' => 'The description cannot be longer than 100 words.']);
    }

    /**
     * User can update an experience test.
     *
     * @return void
     */
    public function test_user_can_update_experience()
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();

        $response = $this->actingAs($user)->post(route('user.org.association.update', $organization), [
            'name' => 'Test Company Updated',
            'associated_as' => 'Developer',
            'start_date' => date("Y-m-d", strtotime("2020-02-15")),
            'end_date' => date("Y-m-d", strtotime("2021-01-15")),
            'description' => 'Testing Descriptions',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('dashboard');
        $this->followRedirects($response)->assertSee('Organization Association updated successfully!');
        $this->assertDatabaseHas(Organization::class, ['id' => $organization->id, 'name' => 'Test Company Updated']);
    }

    /**
     * Experience can delete successfully
     *
     * @return void
     */
    public function test_experience_can_deleted_successfully()
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();

        $response = $this->actingAs($user)->get(route('user.org.association.destroy', $organization));

        $response->assertStatus(302);
        $response->assertRedirect('dashboard');
        $this->followRedirects($response)->assertSee('Organization Association deleted successfully!');
        $this->assertDatabaseMissing(Organization::class, ['id' => $organization->id]);
    }
}
