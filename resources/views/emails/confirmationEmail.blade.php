<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation email from {{ env('APP_NAME') }}</title>
</head>
<body>
    Hello {{ $data['name'] }},
    <br>
    Trust you are keeping safe. Following the recent subscription to our movies newsletter, find the 5-digit otp.

   <b>{{ $data['otp'] }}</b>


</body>
</html>