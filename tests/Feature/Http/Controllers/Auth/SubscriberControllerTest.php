<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriberControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /** @test */
    public function redirect_to_unsubscribe_page()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('unsubscribe'));

        $response->assertStatus(200);
    }
    
}
