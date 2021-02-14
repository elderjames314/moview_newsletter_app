<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
     /** @test */
    public function login_displays_the_login_form()
    {
        $response = $this->get(route("login"));

        $response->assertStatus(200);

        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function login_display_validation_errors()
    {
        $response = $this->post('/login', []);

        $response->assertStatus(302); //redirection
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function login_authenticates_and_redirect_user()
    {
        $user = factory(User::class)->create;

        $data = ([
            "email" => $user->email,
            "password" => "password"
        ]);

        $response = $this->post(route("login"), $data);

        $response->assertRedirect(route("home"));
        $this->assertAuthenticatedAs($user);
    }
    
    
}
