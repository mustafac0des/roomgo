@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-80px)] bg-gray-50 py-12 sm:px-6 lg:px-8">
    <div class="w-full max-w-6xl">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">

             <div class="md:w-5/12 relative hidden md:block">
                <img src="https://images.unsplash.com/photo-1547961547-321889bff29e?q=80&w=2080&auto=format&fit=crop" 
                     alt="Register" 
                     class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-[#9A616D]/30 mix-blend-multiply"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white z-10">
                    <h2 class="text-3xl font-bold font-['Outfit']">Join RoomGo</h2>
                    <p class="mt-2 text-gray-100">Create an account to start hosting or booking premium rooms.</p>
                </div>
            </div>


            <div class="md:w-7/12 p-8 sm:p-12 lg:p-16 flex flex-col justify-center">
                 <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 font-['Outfit']">Sign Up for Room<span class="text-[#9A616D]">GO</span></h2>
                </div>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (['name', 'email', 'phone', 'address', 'picture', 'gender', 'password', 'password_confirmation'] as $field)
                             <div class="{{ in_array($field, ['address', 'picture']) ? 'md:col-span-2' : '' }}">
                                <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 capitalize mb-1">{{ str_replace('_', ' ', $field) }}</label>
                                @if ($field === 'gender')
                                    <select id="gender" name="gender" class="block w-full px-3 py-2 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] sm:text-sm">
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                @elseif ($field === 'picture')
                                    <input type="file" id="picture" name="picture" accept="image/*" class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-[#9A616D]/10 file:text-[#9A616D]
                                      hover:file:bg-[#9A616D]/20
                                    "/>
                                @else
                                    <input id="{{ $field }}" type="{{ in_array($field, ['password', 'password_confirmation']) ? 'password' : ($field === 'email' ? 'email' : 'text') }}" 
                                           name="{{ $field }}" value="{{ old($field) }}" 
                                           {{ in_array($field, ['password', 'password_confirmation']) ? '' : 'required' }}
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] sm:text-sm @error($field) border-red-500 @enderror">
                                @endif
                                
                                @error($field)
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-[#9A616D] hover:bg-[#854d58] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#9A616D] transition transform active:scale-95">
                            Register
                        </button>
                    </div>
                    
                    <div class="text-center text-sm">
                        <a href="{{ route('login') }}" class="font-medium text-[#9A616D] hover:text-[#854d58] transition">
                            Already have an account? Sign In
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
