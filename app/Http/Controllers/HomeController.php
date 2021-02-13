<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }

    public function test(Request $request) {
        // $uniques = range(10000, 99999);
        // shuffle($uniques);
        // return array_slice($uniques, 0, 1)[0];

       // return  $request->header('User-Agent');

       return time();

      // return $request->ip();
    }
}
