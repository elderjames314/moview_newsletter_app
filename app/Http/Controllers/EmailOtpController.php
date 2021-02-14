<?php

namespace App\Http\Controllers;

use App\EmailOtp;
use App\Events\UserSubscribed;
use App\Subscriber;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * @author James, OLADIMEJI
 * This is controller that responsible for Email otp operations
 */

class EmailOtpController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function confirmEmail(Request $request)
    {
        try {
            $otp = $request->otp;
            $request->validate([
                'otp' => 'required'
            ]);

            //fetch the otp in the database with otp send and logged in user id
            $otpModel = EmailOtp::where('otp', $otp)->where("user_id", Auth::user()->id)->first();


            //check if otp model is null
            if ($otpModel == null) {
                return redirect()->back()->with('error', "Otp provided not found, please re-check and try again");
            }

            //check if otp has expired. it is set to be expired in 12hours in the environment file.
            if (checkIfOtpIsExpired($otpModel)) {
                //it has expired.
                return redirect()->back()->with('error', "Otp has expired, please click re-send verification to generate new one");
            }

            //update user subscription
            $this->updateUserSubscription($otpModel);


            //log actitivity
            $activityData = getActivityData("Confirming email");
            logActivity($activityData, $request);

            //if everything is okay, redirect user to unsubscribe page
            return redirect()->route("unsubscribe");
        } catch (\Throwable $th) {
            logError($th, 500);
        }
    }

    public function resendVerification(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);

            //check if user is found.
            if (!$user) {
                return redirect()->back()->with('error', "User not found. could please try and re-login again, it may be your session has expired.");
            }

            //computed email data
            $otp = generateOtp();
            $emailData = ([
                "name" => $user->name,
                "email" => $user->email,
                "otp" => $otp,
                "user_id" => $user->id,
            ]);

            //log otp
            $this->logEmailOtp($otp);

            //fire sending confirm email event
            event(new UserSubscribed($emailData));

            //log actitivity
            $activityData = getActivityData("Resending email verification");
            logActivity($activityData, $request);

            return redirect()->back()->with("success", "New Otp has been generated and sent to your email accordingly, check your mail");
        } catch (\Throwable $th) {
            logError($th, 500);
        }
    }

    private function logEmailOtp($otp)
    {
        EmailOtp::create([
            "user_id" => Auth::user()->id,
            "otp" => $otp
        ]);
    }

   

    private function updateUserSubscription($otpModel)
    {

        //update subscriber tables
        Subscriber::where("user_id", $otpModel->user_id)->update([
            "has_confirmed" => true
        ]);

        //then delete the otp in the database, is of no use again.
        EmailOtp::where('otp', $otpModel->otp)->where("user_id", Auth::user()->id)->delete();
    }
}
