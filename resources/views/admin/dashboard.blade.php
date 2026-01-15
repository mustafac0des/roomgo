@extends('layouts.app')

@if (auth()->check() && auth()->user()->role === 'user')
    <script type="text/javascript">
        window.location.href = "{{ route('home') }}";
    </script>
@endif

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 font-['Outfit']">Admin Portal</h1>
        <p class="mt-2 text-gray-600">Welcome to the administration dashboard.</p>
    </div>

    @if (session('status'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <a href="{{ route('admin.users.index') }}" class="group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition duration-300">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 p-3 rounded-xl group-hover:scale-110 transition duration-300">
                     <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-[#9A616D] transition">Manage Users</h3>
                    <p class="text-sm text-gray-500">View, create, and edit users</p>
                </div>
            </div>
        </a>


        <a href="{{ route('admin.rooms.index') }}" class="group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition duration-300">
            <div class="flex items-center space-x-4">
                 <div class="bg-purple-100 p-3 rounded-xl group-hover:scale-110 transition duration-300">
                     <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-[#9A616D] transition">Manage Rooms</h3>
                    <p class="text-sm text-gray-500">View and manage room listings</p>
                </div>
            </div>
        </a>
    </div>
    
    <div class="mt-8 rounded-2xl overflow-hidden shadow-lg">
        <img src="https://images.unsplash.com/photo-1618044619888-009e412ff12a?q=80&w=2071&auto=format&fit=crop" 
             alt="Admin Dashboard" 
             class="w-full h-64 object-cover">
    </div>
</div>
@endsection
