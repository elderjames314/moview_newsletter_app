<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Newsletter Email</title>
</head>
<body>

    @if(isset($data))
    <?php $TMDBBASEURL = "https://image.tmdb.org/t/p/w500"; ?>
       <table>
           <thead>
            <th></th>
            <th></th>
           </thead>
           <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>
                        <?php $imgUrl = $TMDBBASEURL.$item->img ?>
                        <img src="{{ $imgUrl }}" height="400px" width="400px" alt="{{ $item->title}}'s poster photo">
                    </td>
                    <td style="text-align:top">
                        <div style="padding: 30px">
                            <span style="font-weight: bold; font-size:35px; color:marron">{{ $item->title }}</span> <span>
                                &nbsp;&nbsp;&nbsp;
                                {{ $item->score }} / 10 IMDB
                            </span>
                            <br>
                            <span style="font-style: italic">
                                {{ $item->description }}
                            </span>
                        </div>
                    </td>
                </tr>
            @endforeach
           </tbody>
       </table>
       
    @endif
    
</body>
</html>