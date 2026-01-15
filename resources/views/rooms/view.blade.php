@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 font-['Outfit']">Book A Room</h1>
        <p class="mt-2 text-gray-600">Browse available rooms and find your perfect stay.</p>
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
    
    @if (session('error'))
         <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                     <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
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
            <h3 class="mt-2 text-sm font-medium text-gray-900">No rooms available</h3>
            <p class="mt-1 text-sm text-gray-500">Check back later for new listings.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($rooms as $room)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden group hover:shadow-xl transition duration-300 flex flex-col h-full">
                    <div class="relative h-48 flex-none">
                         <img src="{{ $room->image ? asset('storage/' . $room->image) : 'https://placehold.co/600x400?text=No+Image' }}" 
                             alt="{{ $room->address }}" 
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-900 shadow-sm">
                            ${{ number_format($room->price) }} <span class="text-gray-500 font-normal">/ night</span>
                        </div>
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $room->address }}</h3>
                        <p class="text-sm text-gray-500 mb-4">{{ $room->city }}</p>
                        
                        <div class="grid grid-cols-2 gap-y-2 text-sm text-gray-600 mb-6">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#9A616D]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                <span>{{ $room->beds }} Beds</span>
                            </div>
                            <div class="flex items-center gap-2">
                                 <svg class="w-4 h-4 text-[#9A616D]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                <span>{{ $room->guests }} Guests</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#9A616D]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                <span>{{ $room->washrooms }} Baths</span>
                            </div>
                             <div class="flex items-center gap-2 col-span-2 mt-2">
                                @php
                                    $amenities = is_string($room->amenities) ? json_decode($room->amenities, true) : ($room->amenities ?? []);
                                    // handle case where json_decode returns null if empty string
                                    if(!is_array($amenities)) $amenities = [];
                                    $displayAmenities = array_slice($amenities, 0, 3);
                                @endphp
                                @foreach($displayAmenities as $amenity)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $amenity }}
                                    </span>
                                @endforeach
                                @if(count($amenities) > 3)
                                    <span class="text-xs text-gray-500">+{{ count($amenities) - 3 }} more</span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-auto pt-4 border-t border-gray-100">
                            <a href="{{ route('rooms.order', $room->id) }}" class="block w-full text-center py-3 px-4 bg-[#9A616D] border border-transparent rounded-xl text-sm font-medium text-white hover:bg-[#854d58] transition shadow-md hover:shadow-lg transform active:scale-[0.99]">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
