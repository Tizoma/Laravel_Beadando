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
        <table class="bg-slate-600 rounded-lg overflow-hidden w-8/12 m-auto my-4">
            <thead>
                <tr>
                    <th class="text-left px-4 py-2 border-b border-gray-700 text-white">Name</th>
                    <th class="text-right px-4 py-2 border-b border-gray-700 text-white">Defence</th>
                    <th class="text-right px-4 py-2 border-b border-gray-700 text-white">Strength</th>
                    <th class="text-right px-4 py-2 border-b border-gray-700 text-white">Accuracy</th>
                    <th class="text-right px-4 py-2 border-b border-gray-700 text-white">Magic</th>
                </tr>
            </thead>
            <tbody>
                <tr">
                    <td class="text-left px-4 py-2 border-b border-gray-700 text-white"> {{ $chosenCharacter->name }}</td>
                    <td class="text-right px-4 py-2 border-b border-gray-700 text-white">{{ $chosenCharacter->defence }}</td>
                    <td class="text-right px-4 py-2 border-b border-gray-700 text-white">{{ $chosenCharacter->strength }}</td>
                    <td class="text-right px-4 py-2 border-b border-gray-700 text-white">{{ $chosenCharacter->accuracy }}</td>
                    <td class="text-right px-4 py-2 border-b border-gray-700 text-white">{{ $chosenCharacter->magic }}</td>
                </tr>
            </tbody>
        </table>
        <table class="bg-slate-600 rounded-lg overflow-hidden w-8/12 m-auto my-4">
            <thead>
                <tr>
                    <th class="text-center px-4 py-2 border-b border-gray-700 text-white">Outcome</th>
                    <th class="text-center px-4 py-2 border-b border-gray-700 text-white">Place</th>
                    <th class="text-center px-4 py-2 border-b border-gray-700 text-white">Enemy</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0;$i<count($contestWinArray);$i++)
                <tr>
                    @if ($contestWinArray[$i])
                    <td class="bg-green-500 hover:bg-green-600 text-center px-4 py-2 border-b border-gray-700 text-white"> <a href="{{ route('contests.index') }}"> Win</a></td>
                    @else
                    <td class="bg-red-500 hover:bg-red-600 text-center px-4 py-2 border-b border-gray-700 text-white"> <a href="{{ route('contests.index') }}"> Lose</a></td>
                    @endif
                    <td class="text-center px-4 py-2 border-b border-gray-700 text-white">{{ $placeNameArray[$i] }}</td>
                    <td class="text-center px-4 py-2 border-b border-gray-700 text-white">{{ $otherCharacterNameArray[$i] }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
        <p class="bg-yellow-400 w-16 m-auto my-4 text-white px-4 py-2 rounded hover:bg-yellow-500"><a href="{{ route('characters.edit',$chosenCharacter->id) }}">Edit</a></p>
        <div class="flex justify-center my-4">
        <form action="{{ route('characters.destroy', $chosenCharacter->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-400 w-20 text-white px-4 py-2 rounded hover:bg-red-500" >Delete</button>
        </form>
        </div>
        <p class="bg-green-400 w-32 m-auto my-4 text-white px-4 py-2 rounded hover:bg-green-500"><a href="{{ route('contests.index') }}">New contest</a></p>
    </body>
</html>
