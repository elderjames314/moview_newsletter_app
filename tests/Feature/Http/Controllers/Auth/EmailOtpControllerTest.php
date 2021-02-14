<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\EmailOtp;
use App\Events\UserSubscribed;
use App\Subscriber;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmailOtpControllerTest extends TestCase
{
  use RefreshDatabase, WithFaker;
  /** @test */
  
  public function verify_that_all_operation_emailOtp_is_not_failing()
  {
      $user = factory(User::class)->create();
      $otpModel = factory(EmailOtp::class)->create();
      $otp = $otpModel->otp;
      
     // $otp = $this->faker->randomDigit(5);

      $data = ([
          "otp" => $otp
      ]);

      $response = $this->actingAs($user)->post(route("home"), $data);
      $this->assertNotNull($otpModel);

      $this->assertDatabaseHas("email_otps", [
          "otp" => $otpModel->otp
      ]);

      //check if otp is deleted
      $otp = EmailOtp::where("otp", $otp)->where("user_id", $user->id)->first();
      $this->assertNotNull($otp);

      //create subscriber page accordingly
      Subscriber::create([
          "user_id" => $user->id,
          "has_subscribed" => true,
          "has_confirmed" => false
      ]);

      //assert subscription is updated accordingly
      $subscription = Subscriber::where("user_id", $user->id)->where("has_subscribed", 1)->first();

      $this->assertNotNull($subscription);

      //check the otp validity
      $checkOtpValidity = checkIfOtpIsExpired($otpModel);
      $this->assertFalse($checkOtpValidity);

  }

  /** @test */
  public function very_email_confirmation_is_ok()
  {
      $user = factory(User::class)->create();
      $otpModel = factory(EmailOtp::class)->create();

      $response = $this->actingAs($user)->get(route("resend-verification"));

      //assert user is not null
      $this->assertNotNull($user);

      $emailData = ([
        "name" => $user->name,
        "email" => $user->email,
        "otp" => $otpModel->otp,
        "user_id" => $user->id,
    ]);

    //fire sending confirm email event
    //event(new UserSubscribed($emailData));



    //$response->assertStatus(200);











  }
  



  
}
