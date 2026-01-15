@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-80px)] bg-gray-50 py-12 sm:px-6 lg:px-8">
    <div class="w-full max-w-5xl">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">

            <div class="md:w-1/2 relative hidden md:block">
                <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?q=80&w=2070&auto=format&fit=crop" 
                     alt="Login" 
                     class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-[#9A616D]/30 mix-blend-multiply"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white z-10">
                    <h2 class="text-3xl font-bold font-['Outfit']">Welcome Back</h2>
                    <p class="mt-2 text-gray-100">Sign in to manage your bookings and rooms.</p>
                </div>
            </div>


            <div class="md:w-1/2 p-8 sm:p-12 lg:p-16 flex flex-col justify-center">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 font-['Outfit']">Sign In to Room<span class="text-[#9A616D]">GO</span></h2>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                        <div class="mt-1">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] sm:text-sm transition @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] sm:text-sm transition @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                         <div class="text-sm">
                            <a href="{{ route('register') }}" class="font-medium text-[#9A616D] hover:text-[#854d58] transition">
                                Don't have an account? Register
                            </a>
                        </div>
                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-gray-600 hover:text-gray-900">
                                    Forgot password?
                                </a>
                            </div>
                        @endif
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-[#9A616D] hover:bg-[#854d58] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#9A616D] transition transform active:scale-95">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
