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
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            <span style="font-weight: bold; color:red"></span>{{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <span style="font-weight: bold; color:red"></span>{{ session('success') }}
                    </div>
                @endif


                    <div>
                        
                        <b>
                            Hi {{ getFirstNameOfLoggedInUser(Auth::user()->name) }} we have sent you a verification email. Please enter your 5-digit code here:
                        </b>


                       
                    </div>
                    <div class="justify-center" style="padding: 120px">
                        
                        <form action="{{ route('verifyEmail') }}" method="POST">
                          
                             @csrf
                            
                            <div class="flex justify-center " id="OTPInput">
                            </div>
                            <input hidden id="otp" name="otp" value="{{ old('otp') }}">
                            <br>
                            @error('otp')
                            <span class="" role="alert" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <button class="mt-1 button button-danger font-bold text-lg px-2 pt-2 pb-2 rounded bg-black text-white" id="otpSubmit">Confirm Email Addreess</button>
                        </form>
                        <br>
                        Didn't get an email. <a href="{{ route('resend-verification') }}" style="font-weight: bold">Re-send verification</a>

                    </div>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('otp_generated_script')
<script src="{{ asset('js/otp_generated_script.js') }}" defer></script>
@stop
