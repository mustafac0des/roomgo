<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'RoomGo') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <div id="app" class="min-h-screen flex flex-col">

        <nav class="bg-white shadow-sm border-b border-gray-100 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ url('/landing') }}" class="flex-shrink-0 flex items-center gap-2">
                             <span class="text-2xl font-bold text-gray-900">Room<span class="text-[#9A616D]">GO</span></span>
                        </a>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        @guest
                            <div class="flex gap-4">
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="px-4 py-2 bg-[#9A616D] text-white rounded-lg hover:bg-[#854d58] transition shadow-md">{{ __('Sign In') }}</a>
                                @endif
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 bg-[#9A616D] text-white rounded-lg hover:bg-[#854d58] transition shadow-md">{{ __('Sign Up') }}</a>
                                @endif
                            </div>
                        @else
                            <div class="relative flex items-center gap-3 group cursor-pointer">
                                <div class="text-right hidden sm:block">
                                    <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                                </div>
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-[#9A616D] shadow-sm transform group-hover:scale-105 transition" 
                                     src="{{ Auth::user()->picture ? asset('storage/' . Auth::user()->picture) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}" 
                                     alt="{{ Auth::user()->name }}">
                                
                                <div class="absolute right-0 top-12 w-48 bg-white rounded-xl shadow-xl py-2 hidden group-hover:block border border-gray-100">
                                    <a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#9A616D]">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 gap-8">
            @auth

                <aside class="w-64 flex-shrink-0 hidden md:block">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <nav class="space-y-2">
                            @if(Auth::user()->role == 'user')
                                <x-nav-link href="{{ url('/profile/manage') }}" :active="request()->is('profile/manage')">Manage Profile</x-nav-link>
                                <x-nav-link href="{{ url('/rooms/create') }}" :active="request()->is('rooms/create')">Host A Room</x-nav-link>
                                <x-nav-link href="{{ url('/rooms/manage') }}" :active="request()->is('rooms/manage')">Manage Rooms</x-nav-link>
                                <x-nav-link href="{{ url('/rooms/view') }}" :active="request()->is('rooms/view')">Book A Room</x-nav-link>
                            @endif

                            @if(Auth::user()->role == 'admin')
                                <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">Dashboard</x-nav-link>
                                <x-nav-link href="{{ url('/admin/users') }}" :active="request()->is('admin/users*')">Manage Users</x-nav-link>
                                <x-nav-link href="{{ url('/admin/rooms') }}" :active="request()->is('admin/rooms*')">Manage Rooms</x-nav-link>
                            @endif

                             <a href="{{ route('chat.index') }}" 
                               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#9A616D] hover:text-white transition group border border-transparent hover:shadow-md">
                                <span class="font-medium">AI Assistant</span>
                            </a>
                        </nav>
                    </div>
                </aside>
            @endauth
            <main class="flex-1 w-full">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
