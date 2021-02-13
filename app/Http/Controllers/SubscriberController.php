<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{

    function __construct()
    {
        return $this->middleware('auth');
    }

    public function unsubscribe() {
        //redirect to unsubscribe page
       return view('unsubscription');
    }

    public function stopSendingMovies($user_id) {

        //stop sending movies to this user by set has_subscribe to false
        Subscriber::where("user_id", $user_id)->update([
            'has_subscribed' => false
        ]);
        $subscribe = false;
        return view('unsubscription', compact('subscribe'));

    }
}
