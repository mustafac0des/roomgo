@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden flex flex-col md:flex-row">

        <div class="md:w-5/12 relative hidden md:block">
            <img src="https://images.unsplash.com/photo-1532490389938-2856e3f1560a?q=80&w=2080&auto=format&fit=crop" 
                 alt="Profile" 
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-[#9A616D]/20 mix-blend-multiply"></div>
            <div class="absolute bottom-0 left-0 p-8 text-white z-10">
                <h2 class="text-3xl font-bold font-['Outfit']">Your Profile</h2>
                <p class="mt-2 text-gray-100">Update your personal information and preferences.</p>
            </div>
        </div>


        <div class="md:w-7/12 p-8 sm:p-12">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 font-['Outfit']">Manage Profile</h2>
            </div>
            
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                     <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                     @if(auth()->user()->picture)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . auth()->user()->picture) }}" alt="Current Profile" class="h-20 w-20 rounded-full object-cover border-2 border-white shadow-md">
                        </div>
                     @endif
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                 <label for="picture" class="relative cursor-pointer bg-white rounded-md font-medium text-[#9A616D] hover:text-[#854d58] focus-within:outline-none">
                                    <span>Upload new picture</span>
                                    <input id="picture" name="picture" type="file" class="sr-only" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                         <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" required
                               class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                        @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                         <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                        <select name="gender" id="gender" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                            <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>
                
                <div>
                     <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address', auth()->user()->address) }}" required
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                    @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password (Optional)</label>
                    <input type="password" name="password" id="password"
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                    @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                 <div>
                    <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password-confirm"
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-[#9A616D] hover:bg-[#854d58] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#9A616D] transition transform active:scale-[0.99]">
                        Update Profile
                    </button>
                    <a href="{{ route('home') }}" class="block text-center mt-4 text-sm text-gray-600 hover:text-gray-900">Back to Dashboard</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
