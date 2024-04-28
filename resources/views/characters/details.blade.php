<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Main</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body>
        @include('layouts.navigation')
        @if (Auth::user()->id!=$chosenCharacter->owner_id)
        <script type="text/javascript">
            window.location = "/characters";
        </script>
        @endif
        <p>{{$chosenCharacter->name}}</p>
        <p>{{$chosenCharacter->defence}}</p>
        <p>{{$chosenCharacter->strength}}</p>
        <p>{{$chosenCharacter->accuracy}}</p>
        <p>{{$chosenCharacter->magic}}</p>
        <p>Contests</p>
        @for ($i=0;$i<count($contestWinArray);$i++)
        <p>{{$contestWinArray[$i]}}</p>
        @endfor
        <p>Place names</p>
        @for ($i=0;$i<count($placeNameArray);$i++)
        <p>{{$placeNameArray[$i]}}</p>
        @endfor
        <p>Enemy names</p>
        @for ($i=0;$i<count($otherCharacterNameArray);$i++)
        <p>{{$otherCharacterNameArray[$i]}}</p>
        @endfor
        <p>Modify</p>
        <p>Delete</p>
        <p>New contest</p>
    </body>
</html>
