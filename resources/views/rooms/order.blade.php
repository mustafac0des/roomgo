@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Room Details Card (Left Sidebar) -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden sticky top-24">
                 <img src="{{ $room->image ? asset('storage/' . $room->image) : 'https://placehold.co/600x400?text=Room' }}" 
                     alt="{{ $room->address }}" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2 font-['Outfit']">{{ $room->address }}</h2>
                    <p class="text-sm text-gray-500 mb-4">{{ $room->city }}</p>
                    
                    <div class="space-y-3 text-sm text-gray-600 border-t border-gray-100 pt-4">
                        <div class="flex justify-between">
                            <span>Price per night</span>
                            <span class="font-bold text-gray-900">${{ number_format($room->price) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Max Guests</span>
                            <span>{{ $room->guests }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Beds</span>
                            <span>{{ $room->beds }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Form (Right Content) -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 font-['Outfit']">Complete Your Booking</h1>
                    <p class="mt-2 text-gray-500">Please provide your details to reserve this room.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('rooms.book', $room->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Check-in Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Check-out Date</label>
                             <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Number of Guests</label>
                        <select name="guests" id="guests" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                            @for($i = 1; $i <= $room->guests; $i++)
                                <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>{{ $i }} Guest{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">ID Proof (Optional)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="picture" class="relative cursor-pointer bg-white rounded-md font-medium text-[#9A616D] hover:text-[#854d58] focus-within:outline-none">
                                        <span>Upload a file</span>
                                        <input id="picture" name="picture" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-base font-medium text-white bg-[#9A616D] hover:bg-[#854d58] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#9A616D] transition transform hover:-translate-y-0.5">
                            Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
