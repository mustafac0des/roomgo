@extends('layouts.app')

@section('content')
<div class="relative bg-white overflow-hidden">

    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20 shadow-sm transition">
                    Announcing our new premium rooms. <a href="#rooms" class="font-semibold text-[#9A616D]"><span class="absolute inset-0" aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
                </div>
            </div>
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl font-['Outfit']">Find your perfect stay with <span class="text-[#9A616D]">RoomGo</span></h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">Experience comfort, luxury, and convenience. Book your next getaway with ease and enjoy premium amenities at affordable prices.</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('register') }}" class="rounded-xl bg-[#9A616D] px-6 py-3.5 text-sm font-semibold text-white shadow-xl hover:bg-[#854d58] transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#9A616D]">Get started</a>
                </div>
            </div>
        </div>
        
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>


    <div id="rooms" class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-base font-semibold leading-7 text-[#9A616D]">Premium Stays</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Featured Rooms</p>
                <p class="mt-6 text-lg leading-8 text-gray-600">Explore our selection of hand-picked rooms designed for your comfort.</p>
            </div>
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                <article class="flex flex-col items-start justify-between bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300">
                    <div class="relative w-full aspect-[16/9]">
                        <img src="https://images.unsplash.com/photo-1518012312832-96aea3c91144?q=80&w=1974&auto=format&fit=crop" alt="" class="absolute inset-0 h-full w-full object-cover">
                        <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                    </div>
                    <div class="max-w-xl p-6">
                        <div class="mt-2 flex items-center gap-x-4 text-xs">
                            <span class="text-gray-500">1 Bed, 1 Washroom</span>
                            <span class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">PKR 4,999</span>
                        </div>
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    Deluxe Suite
                                </a>
                            </h3>
                            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">Enjoy breathtaking views and premium amenities in our Deluxe Suite.</p>
                        </div>
                    </div>
                </article>


                <article class="flex flex-col items-start justify-between bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300">
                    <div class="relative w-full aspect-[16/9]">
                         <img src="https://images.unsplash.com/photo-1560184897-502a475f7a0d?q=80&w=2070&auto=format&fit=crop" alt="" class="absolute inset-0 h-full w-full object-cover">
                        <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                    </div>
                    <div class="max-w-xl p-6">
                        <div class="mt-2 flex items-center gap-x-4 text-xs">
                            <span class="text-gray-500">2 Beds, 1 Washroom</span>
                             <span class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">PKR 8,999</span>
                        </div>
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    Family Apartment
                                </a>
                            </h3>
                            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">Perfect for families, spacious living area and modern kitchen facilities.</p>
                        </div>
                    </div>
                </article>


                <article class="flex flex-col items-start justify-between bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300">
                     <div class="relative w-full aspect-[16/9]">
                        <img src="https://images.unsplash.com/photo-1549638441-b787d2e11f14?q=80&w=2070&auto=format&fit=crop" alt="" class="absolute inset-0 h-full w-full object-cover">
                        <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                    </div>
                    <div class="max-w-xl p-6">
                        <div class="mt-2 flex items-center gap-x-4 text-xs">
                            <span class="text-gray-500">1 Bed, 1 Washroom</span>
                             <span class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">PKR 3,999</span>
                        </div>
                        <div class="group relative">
                             <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    Standard Room
                                </a>
                            </h3>
                            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">Cozy and affordable, ideal for solo travelers or couples.</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection
