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
        <header >
            @if (Route::has('login'))
            @auth
            @include('layouts.navigation')

            @else
            <nav class="-mx-3 flex flex-1 justify-end bg-white border-b border-gray-100">
                        <a
                            href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-white hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-white hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                Register
                            </a>
                        @endif
                    </nav>
                    @endauth
            @endif
        </header>
        <h1 class="flex justify-center my-4">Laravel Beadandó</h1>
        <p class="flex justify-center my-4">On this page, you can play an arcade style turn based fighting game. In order to access other feutures, please log in/register!</p>
        @if(isset($characterCount))
        <p class="flex justify-center my-4">Number of characters: {{ $characterCount }}</p>
        @endif
        @if(isset($contestCount))
        <p class="flex justify-center my-4">Number of contests: {{ $contestCount }}</p>
        @endif
    </body>
</html>
