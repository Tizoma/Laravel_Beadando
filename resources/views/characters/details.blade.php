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
        <p></p>
        @foreach ($chosenContests as $chosenContest){
            {{$chosenContest->id}}
            {{$chosenContest->win}}
        }
        @endforeach
        <p>Enemies</p>
        <p></p>
        @foreach ($otherCharacters as $otherCharacter)
            {{$otherCharacter->character_id}}
        @endforeach
    </body>
</html>
