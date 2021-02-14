<?php

namespace App\Http\Controllers;

use App\Mail\NewsLetter;
use App\Subscriber;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //check if the user has already subscribed and confirmed.
        $subscriber = Auth::user()->subscriber;

        if ($subscriber != null && $subscriber->has_subscribed && $subscriber->has_confirmed) {
            //if this true,
            //redirect him to unsubscribe page
            return view('unsubscription');
        }
        return view('home');
    }

    public function test(Request $request)
    {
        // $uniques = range(10000, 99999);
        // shuffle($uniques);
        // return array_slice($uniques, 0, 1)[0];

        // return  $request->header('User-Agent');

    //     $activeSubscribers = Subscriber::where("has_subscribed", 1)->where("has_confirmed", 1)->get();

    //    for ($i=0; $i < count($activeSubscribers); $i++) { 
    //        dd( $activeSubscribers[$i]->user->email);
    //    }

        // $topRated =  getTopRatedMovies();
        // return view('emails.newsletterEmail', compact('topRated'));


         //get the list of the active subscribers
    $activeSubscribers = getActiveSubscribers();

    for ($i=0; $i < count($activeSubscribers); $i++) { 

        //dd($activeSubscribers[$i]->user->email);
       
        $data = getTopRatedMovies();

    

       Mail::to($activeSubscribers[$i]->user->email)->send(new NewsLetter($data));

      
  
    }

    return "email sent successfully";

    }
}
