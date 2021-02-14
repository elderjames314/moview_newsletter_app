<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @author James, OLADIMEJI
 * This is controller that responsible for subscribing/unsubscribing operations
 */


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

    public function stopSendingMovies($user_id, Request $request) {
       $this->subscription($user_id, false, "User has unsubscribed from our newsletter", $request);
       $subscribe = false;
       return view('unsubscription', compact('subscribe'));
    }
    public function subscribeBack(Request $request) {
        $this->subscription(Auth::user()->id, true, "User wish to subscribe back to our newsletter", $request);
        $message = "We are glad to have you back once again, you subscription has been successfully activated.";
        return view('unsubscription', compact('message'));
    }

    private function subscription($user_id, $subscribe_status, $activity, $request) {
        try {
            Subscriber::where("user_id", $user_id)->update([
                'has_subscribed' => $subscribe_status
            ]);
            $activityData = getActivityData($activity);
            logActivity($activityData, $request);
        } catch (\Throwable $th) {
           logError($th, 500);
        }
        
       
    }
}
