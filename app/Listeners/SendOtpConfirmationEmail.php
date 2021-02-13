<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
use App\Mail\ConfirmationEmail;
use App\Subscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOtpConfirmationEmail
{
  
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  UserSubscribed  $event
     * @return void
     */
    public function handle(UserSubscribed $event)
    {
        Mail::to($event->data["email"])->send(
            new ConfirmationEmail($event->data)
        );


        //subscribe this user to our newsletter upon sending the verification email
        //if new user, new record will be created else it will be updated.
        Subscriber::updateOrCreate([
            'user_id' => $event->data["user_id"],
            "has_subscribed" => true,
            "has_confirmed" => false
        ]);
    }
}
