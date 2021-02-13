@extends('layouts.app')

@section('content')
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <img width="650px" height="500px" src="{{ asset('storage/images/movie_photo.jpg') }}" alt="Movie photo">
        </div>
        <div class="col-md-5">
            <div class="card">
              

                <div class="card-body">

                    @if (isset($subscribe) && !$subscribe)
                    <div class="alert alert-info" role="alert">
                        <span style="font-weight: bold; color:red"> 
                            You have successfully unsubscribe from our newsletters.

                            <a href="#">Subscribe back</a>
                    </div>

                    @else 

                    <div>
                        
                        <b>
                           Unsubcribe to our daily movie recommendation
                        </b>


                       
                    </div>
                    <div class="justify-center" style="padding: 120px">
                        
                        <a href="{{ route('stopSendingMovies', Auth::user()->id) }}" class="mt-1 button button-danger font-bold text-lg px-2 pt-2 pb-2 rounded bg-black text-white" id="otpSubmit">Stop Sending Movies</a>
                       

                    </div>

                    @endif
                  

                   

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

