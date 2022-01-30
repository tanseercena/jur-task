<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * Test User can update Profile
     *
     * @return void
     */
    public function test_user_can_update_own_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('user.profile.update', $user), [
            'first_name' => 'John',
            'last_name'  => 'Cena',
            'email'      => 'john.cena@gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('dashboard');
        $this->followRedirects($response)->assertSee('Profile updated successfully!');
    }

    /**
     * Test User Profile can't update without first name
     *
     * @return void
     */
    public function test_user_pofile_cant_update_without_first_name()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('user.profile.update', $user), [
            'first_name' => '',
            'last_name'  => 'Cena',
            'email'      => 'test@gmail.com',
        ]);

        $response->assertSessionHasErrors('first_name');
    }

    /**
     * Test User Profile can't update without Email
     *
     * @return void
     */
    public function test_user_pofile_cant_update_without_email()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('user.profile.update', $user), [
            'first_name' => 'Test',
            'last_name'  => 'Cena',
            'email'      => '',
        ]);

        $response->assertSessionHasErrors('email');
    }


}
