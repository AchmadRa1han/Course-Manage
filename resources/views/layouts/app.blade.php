<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col">

        <aside class="w-64 h-screen bg-gray-800 text-white fixed top-0 left-0">
            <div class="p-4">
                <h2 class="text-xl font-bold">Dashboard</h2>
            </div>
            @include('layouts.sidebar') 
        </aside>

        <main class="ml-64 p-4 flex-grow">
            <header class="bg-white p-4 shadow-md flex justify-between items-center">
                <h1 class="text-2xl font-bold">
                    @if (Auth::check())
                        @switch(Auth::user()->role)
                            @case('admin')
                                Selamat Datang, Admin {{ Auth::user()->name }}!
                                @break
                            @case('teacher')
                                Selamat Datang, Guru {{ Auth::user()->name }}!
                                @break
                            @case('student')
                                Selamat Datang, Siswa {{ Auth::user()->name }}!
                                @break
                            @default
                                Selamat Datang, {{ Auth::user()->name }}!
                        @endswitch
                    @else
                        Selamat Datang!
                    @endif
                </h1>
                <div class="flex items-center">
                    <a href="{{ route('homepage') }}" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center mr-4">Kembali ke Home</a>
                    @if (Auth::check())
                    <button id="dropdownButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Profile <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logout</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </header>
            <div class="mt-4 bg-white p-4 shadow-md flex-grow">
                {{ $slot }}
            </div>

        </main>

        <footer class="bg-white p-4 shadow-md mt-4 text-center">
            &copy; 2023 Tutoring Platform
        </footer>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</body>
</html>
