<?php

use App\Subscriber;
use App\User;
use Illuminate\Support\Facades\Http;

/**
 * @author James, OLADIMEJI
 * this helper functions will help us get remote movie data
 */

 function getTopRatedMovies() {
   
    //coming from TMDB 
    $url = "https://api.themoviedb.org/3/movie/top_rated?api_key=80c60470e40749de4a99e806bffe43e2&language=en-US&page=1";


    $response = Http::get($url);

    $responseBody = json_decode($response->getBody());

    return $responseBody;
 }

 function getActiveSubscribers() {
     //get the list of users that are subscribed and confirmed.
     $activeSubscribers = Subscriber::where("has_subscribed", 1)->where("has_confirmed", 1)->get();

     return $activeSubscribers;
 }

 function tmdbBaseUrl() {
     return "https://image.tmdb.org/t/p/w500";
 }