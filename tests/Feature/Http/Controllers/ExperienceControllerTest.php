<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExperienceControllerTest extends TestCase
{
    use WithFaker;

    /**
     * User can create an experience test.
     *
     * @return void
     */
    public function test_user_can_create_experience()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('user.experience.store'), [
            'company' => 'Test Company',
            'title' => 'Developer',
            'start_date' => date("Y-m-d", strtotime("2020-02-15")),
            'end_date' => date("Y-m-d", strtotime("2021-01-15")),
            'description' => 'Testing Descriptions',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('dashboard');
        $this->followRedirects($response)->assertSee('Experience added successfully!');
    }

    /**
     * User can't create experience if description greater than 300 words.
     *
     * @return void
     */
    public function test_user_cant_create_experience_if_description_greater_than_300_words()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('user.experience.store'), [
            'company' => 'Test Company',
            'title' => 'Developer',
            'start_date' => date("Y-m-d", strtotime("2020-02-15")),
            'end_date' => date("Y-m-d", strtotime("2021-01-15")),
            'description' => $this->faker->sentence(400),
        ]);

        $response->assertSessionHasErrors(['description' => 'The description cannot be longer than 300 words.']);
    }

    /**
     * User can update an experience test.
     *
     * @return void
     */
    public function test_user_can_update_experience()
    {
        $user = User::factory()->create();
        $experience = Experience::factory()->create();

        $response = $this->actingAs($user)->post(route('user.experience.update', $experience), [
            'company' => 'Test Company Updated',
            'title' => 'Developer',
            'start_date' => date("Y-m-d", strtotime("2020-02-15")),
            'end_date' => date("Y-m-d", strtotime("2021-01-15")),
            'description' => 'Testing Descriptions',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('dashboard');
        $this->followRedirects($response)->assertSee('Experience updated successfully!');
        $this->assertDatabaseHas(Experience::class, ['id' => $experience->id, 'company' => 'Test Company Updated']);
    }

    /**
     * Experience can delete successfully
     *
     * @return void
     */
    public function test_experience_can_deleted_successfully()
    {
        $user = User::factory()->create();
        $experience = Experience::factory()->create();

        $response = $this->actingAs($user)->get(route('user.experience.destroy', $experience));

        $response->assertStatus(302);
        $response->assertRedirect('dashboard');
        $this->followRedirects($response)->assertSee('Experience deleted successfully!');
        $this->assertDatabaseMissing(Experience::class, ['id' => $experience->id]);
    }

}
