<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Newsletter Email</title>
</head>
<body>

    @if(isset($topRated))
    <?php $TMDBBASEURL = "https://image.tmdb.org/t/p/w500"; ?>
       <table>
           <thead>
            <th></th>
            <th></th>
           </thead>
           <tbody>
            @foreach ($topRated->results as $item)
                <tr>
                    <td>
                        <?php $imgUrl = $TMDBBASEURL.$item->poster_path ?>
                        <img src="{{ $imgUrl }}" height="400px" width="400px" alt="{{ $item->original_title }}'s poster photo">
                    </td>
                    <td style="text-align:top">
                        <div style="padding: 30px">
                            <span style="font-weight: bold; font-size:35px; color:marron">{{ $item->original_title }}</span> <span>
                                &nbsp;&nbsp;&nbsp;
                                {{ $item->vote_average }} / 10 IMDB
                            </span>
                            <br>
                            <span style="font-style: italic">
                                {{ $item->overview }}
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