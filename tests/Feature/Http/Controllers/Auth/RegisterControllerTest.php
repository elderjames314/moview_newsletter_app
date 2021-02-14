<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /** @test */
    public function register_create_and_authenticate_a_user()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password(8);

        $data = ([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "password_confirmation" => $password
        ]);
        $response = $this->post(route("register"), $data);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email
        ]);

        $response->assertRedirect(route("home"));

        $user = User::where("name", $name)->where("email", $email)->first();

        $this->assertNotNull($user);
        $this->assertAuthenticatedAs($user);
    }
    /** @test */
    public function get_home_view()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route("home"));

        $response->assertStatus(200);
    }

    /** @test */
    public function display_login_when_accessing_home_and_not_authenticated()
    {
        $response = $this->get(route("home"));
        $response->assertRedirect(route("login"));
    }
    
    
}
