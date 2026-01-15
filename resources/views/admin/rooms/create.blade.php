@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 font-['Outfit']">Create New Room (Admin)</h2>
            <p class="mt-2 text-gray-500">Add a room on behalf of a host.</p>
        </div>

        <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="host_email" class="block text-sm font-medium text-gray-700 mb-1">Host Email</label>
                <input type="email" name="host_email" id="host_email" value="{{ old('host_email') }}" required
                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm" placeholder="Enter host email">
                @error('host_email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Address and City -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" required
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                    @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                     <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <input type="text" name="city" id="city" value="{{ old('city') }}" required
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                    @error('city') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                     <label for="beds" class="block text-sm font-medium text-gray-700 mb-1">Beds</label>
                    <input type="number" name="beds" id="beds" min="1" value="{{ old('beds', 1) }}" required
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                </div>
                 <div>
                     <label for="washrooms" class="block text-sm font-medium text-gray-700 mb-1">Washrooms</label>
                    <input type="number" name="washrooms" id="washrooms" min="1" value="{{ old('washrooms', 1) }}" required
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                </div>
                 <div>
                     <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Max Guests</label>
                    <input type="number" name="guests" id="guests" min="1" value="{{ old('guests', 2) }}" required
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                </div>
            </div>

            <!-- Price -->
            <div>
                 <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price per Night (PKR)</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">PKR</span>
                    </div>
                    <input type="number" name="price" id="price" min="0" value="{{ old('price') }}" required
                           class="block w-full pl-14 pr-12 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm" placeholder="0.00">
                </div>
                 @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Image -->
            <div>
                 <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Room Image</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                             <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-[#9A616D] hover:text-[#854d58] focus-within:outline-none">
                                <span>Upload a file</span>
                                <input id="image" name="image" type="file" class="sr-only" required accept="image/*">
                            </label>
                        </div>
                    </div>
                </div>
                @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Amenities -->
            <div>
                <span class="block text-sm font-medium text-gray-700 mb-2">Amenities</span>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach(['Wifi', 'Parking', 'AC', 'TV', 'Kitchen', 'Gym', 'Pool'] as $amenity)
                        <label class="inline-flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="{{ $amenity }}" class="rounded text-[#9A616D] focus:ring-[#9A616D] border-gray-300">
                            <span class="text-gray-700 text-sm">{{ $amenity }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="pt-6 flex gap-4">
                <button type="submit" class="flex-1 justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-[#9A616D] hover:bg-[#854d58] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#9A616D] transition transform active:scale-[0.99]">
                    Create Room
                </button>
                 <a href="{{ route('admin.rooms.index') }}" class="flex-none justify-center py-3 px-6 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#9A616D] transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
