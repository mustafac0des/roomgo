@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
             <h1 class="text-3xl font-bold text-gray-900 font-['Outfit']">My Rooms</h1>
            <p class="mt-2 text-gray-600">Overview of the rooms you are hosting.</p>
        </div>
        <a href="{{ route('rooms.create') }}" class="inline-flex items-center px-5 py-2.5 bg-[#9A616D] border border-transparent rounded-xl font-medium text-sm text-white hover:bg-[#854d58] shadow-md transition transform hover:-translate-y-0.5">
            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            List New Room
        </a>
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

    @if($rooms->isEmpty())
        <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
             <div class="mx-auto h-12 w-12 text-gray-300">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No rooms listed</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new room listing.</p>
            <div class="mt-6">
                 <a href="{{ route('rooms.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#9A616D] hover:bg-[#854d58] transition">
                    List a Room
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($rooms as $room)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden group hover:shadow-xl transition duration-300">
                    <div class="relative h-48">
                         <img src="{{ $room->image ? asset('storage/' . $room->image) : 'https://placehold.co/600x400?text=No+Image' }}" 
                             alt="{{ $room->address }}" 
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-900 shadow-sm">
                            ${{ number_format($room->price) }} <span class="text-gray-500 font-normal">/ night</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $room->address }}</h3>
                        <p class="text-sm text-gray-500 mb-4">{{ $room->city }}</p>
                        
                        <div class="flex justify-between items-center text-sm text-gray-600 mb-6">
                             <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                {{ $room->beds }} Beds
                            </div>
                            <div class="flex items-center gap-1">
                                 <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                {{ $room->guests }} Guests
                            </div>
                            <div class="flex items-center gap-1">
                                 <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                {{ $room->washrooms }} Baths
                            </div>
                        </div>

                        <div class="flex gap-2">
                             <a href="{{ route('rooms.edit', $room->id) }}" class="flex-1 text-center py-2 px-4 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
