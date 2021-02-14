<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Something went wrong</title>

    <style>
        .center {
  margin: auto;
  width: 50%;
  border: 3px solid green;
  padding: 10px;
}
    </style>
</head>
<body>

    <div class="">
        <h1>Sorry, we had some technical problems during your last operations</h1>

        <br>
        <br>
        Status code: {{ $status_code }}

        <br>
        <br>
    
        <span style="font-weight: bold">
            <a href="#">Request assistance</a>
        </span>
    
        <br>
        <br>
    
        return to <a href="{{ url()->previous() }}">previous page</a>
    </div>
   
</body>
</html>