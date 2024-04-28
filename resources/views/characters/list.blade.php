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
    <body >
        @include('layouts.navigation')
        </header>
        @if(isset($userCharacters))
        <table class="bg-slate-600 rounded-lg overflow-hidden w-2/4 m-auto my-4">
            <thead>
                <tr>
                    <th class="text-left px-4 py-2 border-b border-gray-700 text-white">Name</th>
                    <th class="text-right px-4 py-2 w-40 border-b border-gray-700 text-white">Defence</th>
                    <th class="text-right px-4 py-2 w-40 border-b border-gray-700 text-white">Strength</th>
                    <th class="text-right px-4 py-2 w-40 border-b border-gray-700 text-white">Accuracy</th>
                    <th class="text-right px-4 py-2 w-40 border-b border-gray-700 text-white">Magic</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userCharacters as $userCharacter)
                <tr">
                    <td class="text-left px-4 py-2 border-b border-gray-700 text-white"><a href="{{ route('details', ['id'=>$userCharacter->id]) }}">{{ $userCharacter->name }}</a></td>
                    <td class="text-right px-4 py-2 border-b border-gray-700 text-white">{{ $userCharacter->defence }}</td>
                    <td class="text-right px-4 py-2 border-b border-gray-700 text-white">{{ $userCharacter->strength }}</td>
                    <td class="text-right px-4 py-2 border-b border-gray-700 text-white">{{ $userCharacter->accuracy }}</td>
                    <td class="text-right px-4 py-2 border-b border-gray-700 text-white">{{ $userCharacter->magic }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </body>
</html>
