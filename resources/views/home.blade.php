@extends('layouts.app')

@if (auth()->check() && auth()->user()->role === 'admin')
    <script type="text/javascript">
        window.location.href = "{{ url('admin/users') }}";
    </script>
@endif

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 font-['Outfit']">Welcome, <span class="text-[#9A616D]">{{ Auth::user()->name }}</span></h1>
        <p class="mt-2 text-gray-600">Manage your bookings and rooms from your dashboard.</p>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        

        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Your Reservations</h3>
                    <span class="bg-[#9A616D]/10 text-[#9A616D] py-1 px-3 rounded-full text-xs font-medium">{{ $reservations->count() }} Bookings</span>
                </div>
                
                <div class="p-6">
                    @if ($reservations->isEmpty())
                         <div class="text-center py-8">
                            <div class="mx-auto h-12 w-12 text-gray-300">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No reservations</h3>
                            <p class="mt-1 text-sm text-gray-500">You haven't booked any rooms yet.</p>
                            <div class="mt-6">
                                <a href="{{ route('rooms.view') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#9A616D] hover:bg-[#854d58] transition">
                                    Book a Room
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($reservations as $reservation)
                                <div class="flex flex-col sm:flex-row gap-4 p-4 rounded-xl border border-gray-100 hover:shadow-md transition bg-gray-50/50">
                                    <img src="{{ asset('storage/' . $reservation->room->image) }}" class="h-24 w-full sm:w-32 object-cover rounded-lg shadow-sm" alt="Room Image">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="text-base font-semibold text-gray-900">{{ $reservation->room->address }}</h4>
                                                <p class="text-sm text-gray-500">ID #{{ $reservation->room->id }}</p>
                                            </div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $reservation->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                  ($reservation->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </div>
                                        
                                        <div class="mt-2 flex flex-wrap gap-2 text-sm text-gray-600">
                                             <div class="flex items-center gap-1">
                                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($reservation->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($reservation->end_date)->format('M d, Y') }}
                                            </div>
                                            <div class="flex items-center gap-1 font-medium text-gray-900">
                                                <span>Total: ${{ number_format($reservation->price) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>


            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Your Rooms & Bookings</h3>
                    <a href="{{ route('rooms.create') }}" class="text-sm text-[#9A616D] hover:text-[#854d58] font-medium">+ Add Room</a>
                </div>
                <div class="p-6">
                     @if ($rooms->isEmpty())
                        <p class="text-center text-gray-500 py-4">You are not hosting any rooms.</p>
                     @else
                        <div class="space-y-8">
                            @foreach ($rooms as $room)
                                <div class="border border-gray-200 rounded-xl overflow-hidden">
                                    <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-b border-gray-200">
                                         <div class="flex items-center gap-3">
                                            <img src="{{ asset('storage/' . $room->image) }}" class="h-10 w-10 object-cover rounded-md" alt="Room">
                                            <div>
                                                <span class="block text-sm font-semibold text-gray-900">{{ $room->address }}</span>
                                                <span class="block text-xs text-gray-500">ID #{{$room->id}}</span>
                                            </div>
                                         </div>
                                    </div>
                                    
                                    <div class="divide-y divide-gray-100">
                                        @forelse ($room->bookings as $booking)
                                            <div class="p-4 flex flex-col sm:flex-row justify-between items-center gap-4 hover:bg-gray-50 transition">
                                                <div class="flex items-center gap-3 w-full sm:w-auto">
                                                    <img src="{{ asset('storage/' . $room->image) }}" class="h-8 w-8 rounded-full object-cover shadow-sm bg-gray-200" alt="Guest">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">{{ $booking->guest_name }} <span class="text-gray-400">|</span> {{ $booking->guest_phone }}</p>
                                                        <p class="text-xs text-gray-500">
                                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d') }}
                                                            &bull; ${{ number_format($booking->price) }}
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                                    @if ($booking->status == 'occupied')
                                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Active</span>
                                                        <form action="{{ route('rooms.updateBookingStatus', $booking->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" name="status" value="completed" class="text-xs bg-green-500 text-white px-3 py-1.5 rounded-lg hover:bg-green-600 transition shadow-sm">Mark Complete</button>
                                                        </form>
                                                    @elseif ($booking->status == 'pending')
                                                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pending</span>
                                                        <form action="{{ route('rooms.updateBookingStatus', $booking->id) }}" method="POST" class="flex gap-2">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" name="status" value="occupied" class="text-xs bg-[#9A616D] text-white px-3 py-1.5 rounded-lg hover:bg-[#854d58] transition shadow-sm">Accept</button>
                                                            <button type="submit" name="status" value="rejected" class="text-xs bg-red-100 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg hover:bg-red-50 transition">Reject</button>
                                                        </form>
                                                    @elseif ($booking->status == 'rejected')
                                                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Rejected</span>
                                                    @else
                                                        <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">{{ ucfirst($booking->status) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                            <div class="p-4 text-center text-sm text-gray-500">
                                                No bookings for this room yet.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        

        <div class="space-y-8">
             <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('profile.update') }}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition border border-gray-100">
                        <svg class="h-6 w-6 text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-xs font-medium text-gray-700">Profile</span>
                    </a>
                    <a href="{{ route('rooms.create') }}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition border border-gray-100">
                         <svg class="h-6 w-6 text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-xs font-medium text-gray-700">Add Room</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
