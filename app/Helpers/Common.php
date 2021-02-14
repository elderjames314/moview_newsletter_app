<?php

/**
 * @author James, OLADIMEJI
 * These are the utilities functions that will be needed time to time in the course of building application
 */

use App\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * This methods is called every activity perform in this system
 * @param activity, remarks
 * @return App\ActivityLog
 */
function logActivity($data, $request)
{
    $user_agent = $request->header('User-Agent');
    $remarks = $user_agent;
    $browser = getBrowser($user_agent);
    $os = getOS($user_agent);
    $fullname = $data["name"];
    $email = $data["email"];
    $activity = $data["activity"];

    return ActivityLog::create([
        "fullname" => $fullname,
        "email" => $email,
        "browser" => $browser,
        "ip_address" => $request->ip(),
        "os" => $os,
        "activity" => $activity,
        "remarks" => $remarks
    ]);
}


/**
 * Get the specific OS that is using our application
 * @param $user_agent
 * @return OS
 */
function getOS($user_agent)
{
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

/**
 * Get the specific browser name
 * @param $user_agent
 * @return browser name
 */
function getBrowser($user_agent)
{

    $browser = "Unknown Browser";
    $browser_array = array(
        '/msie/i'      => 'Internet Explorer',
        '/firefox/i'   => 'Firefox',
        '/safari/i'    => 'Safari',
        '/chrome/i'    => 'Chrome',
        '/edge/i'      => 'Edge',
        '/opera/i'     => 'Opera',
        '/netscape/i'  => 'Netscape',
        '/maxthon/i'   => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i'    => 'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

function getFirstNameOfLoggedInUser($fullname)
{
    $arr = explode(' ', trim($fullname));
    return $arr[0];
}

function logError($error, $status_code)
{
    Log::debug('Something went wrong during user registration: ' . $error);
    //abort($status_code);
    return response()->view('errors.error', compact('status_code'));
}

/**
 * Generate 5-digit otp for email confirmation
 * @return otp
 */
function generateOtp()
{
    $uniques = range(10000, 99999);
    shuffle($uniques);
    return array_slice($uniques, 0, 1)[0];
}

function getActivityData($activity) {
    $activityData = ([
        "name" => Auth::user()->name,
        "email" => Auth::user()->email,
        "activity" => $activity
    ]);
    //dd($activityData);
    return $activityData;
}

function checkIfOtpIsExpired($otpModel)
{
    $created_at = strtotime($otpModel->created_at);
    $now = time();
    $hoursSpent = abs($created_at - $now) / (60 * 60);
    return $hoursSpent >  (int)env('EMAIL_OTP_EXPIRED') ? true : false;
}
