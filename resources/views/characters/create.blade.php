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
        <form action="{{ route('characters.store') }}" class="w-96 m-auto my-4" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="block text-sm font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="defence" class="block text-sm font-semibold mb-2">Defence</label>
                <input type="number" name="defence" id="defence" class="w-full p-2 border border-gray-300 rounded" value="{{ old('defence') }}">
                @error('defence')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="strength" class="block text-sm font-semibold mb-2">Strength</label>
                <input type="number" name="strength" id="strength" class="w-full p-2 border border-gray-300 rounded" value="{{ old('strength') }}">
                @error('strength')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="accuracy" class="block text-sm font-semibold mb-2">Accuracy</label>
                <input type="number" name="accuracy" id="accuracy" class="w-full p-2 border border-gray-300 rounded" value="{{ old('accuracy') }}">
                @error('accuracy')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="magic" class="block text-sm font-semibold mb-2">Magic</label>
                <input type="number" name="magic" id="magic" class="w-full p-2 border border-gray-300 rounded" value="{{ old('magic') }}">
                @error('magic')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            @error('points')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            @if(Auth::user()->admin)
            <div class="mb-3">
                <input type="checkbox" name="enemy" id="enemy" value="1" {{ old('enemy') ? 'checked' : '' }}>
                <label for="enemy" class="block text-sm font-semibold mb-2">Enemy</label>
                @error('enemy')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endif
            <div class="mb-3">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create new character</button>
            </div>

        </form>
    </body>
</html>
