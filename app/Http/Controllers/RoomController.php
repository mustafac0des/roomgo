<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('bookings')->where('host_id', auth()->id())->get();
        return view('rooms.manage', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function bookings()
    {
        $rooms = Room::with(['bookings' => function($query) {
        }])->where('host_id', auth()->id())->get();

        $reservations = Booking::with(['room' => function($query) {
        }])->where('user_id', auth()->id())->get();

        return view('home', compact('rooms', 'reservations'));
    }

    public function updateBookingStatus(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $validStatuses = ['rejected', 'pending', 'occupied', 'completed'];
        if (!in_array($request->status, $validStatuses)) {
            return back()->with('error', 'Invalid status.');
        }

        if ($request->status == 'occupied') {
            $pendingBookings = Booking::where('room_id', $booking->room_id)
                                    ->where('status', 'pending')
                                    ->where('id', '!=', $bookingId)
                                    ->get();

            foreach ($pendingBookings as $pendingBooking) {
                $pendingBooking->status = 'rejected';
                $pendingBooking->save();
            }
        }

        $booking->status = $request->status;
        $booking->save();

        return back()->with('status', 'Booking status updated successfully.');
    }


    public function stores(Request $request)
    {
        $validated = $request->validate([
            'beds' => 'required|integer',
            'washrooms' => 'required|integer',
            'guests' => 'required|integer',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user_id = Auth::id();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $path = $request->image->storeAs('images', $imageName, 'public');
        } else {
            $path = null;
        }

        Room::create([
            'host_id' => $user_id,
            'beds' => $validated['beds'],
            'washrooms' => $validated['washrooms'],
            'guests' => $validated['guests'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'price' => $validated['price'],
            'amenities' => json_encode($validated['amenities'] ?? []),
            'image' => $path,
        ]);

        return redirect('/')->with('status', 'Room added successfully!');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);

        if ($room->host_id != auth()->id()) {
            return redirect()->route('rooms.index')->with('error', 'You can only edit your own rooms.');
        }

        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'beds' => 'required|integer|min:1',
            'washrooms' => 'required|integer|min:1',
            'guests' => 'required|integer|min:1',
            'price' => 'required|numeric|min:1',
            'amenities' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $room = Room::findOrFail($id);

        if ($room->host_id != auth()->id()) {
            return redirect()->route('rooms.index')->with('error', 'You can only update your own rooms.');
        }

        if ($request->hasFile('image')) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $imageName = time() . '.' . $request->image->extension();
            $path = $request->image->storeAs('images', $imageName, 'public');
            $data['image'] = $path;
        }

        $room->update([
            'address' => $request->address,
            'city' => $request->city,
            'beds' => $request->beds,
            'washrooms' => $request->washrooms,
            'guests' => $request->guests,
            'price' => $request->price,
            'amenities' => json_encode($request->amenities),
            'image' => $data['image'] ?? $room->image,
        ]);

        return redirect()->route('rooms.index')->with('status', 'Room updated successfully!');
    }


    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        $hasNonOccupiedBookings = $room->bookings->where('status', '!=', 'occupied')->isNotEmpty();

        if ($hasNonOccupiedBookings) {
            return redirect()->route('rooms.manage')->with('error', 'Room cannot be deleted because it is occupied!');
        }

        $room->delete();

        return redirect()->route('rooms.index')->with('status', 'Room deleted successfully!');
    }

    public function availableRooms()
    {
        $rooms = Room::with('bookings')
                    ->where('host_id', '!=', auth()->id())
                    ->whereDoesntHave('bookings', function ($query) {
                        $query->where('status', 'occupied');
                    })
                    ->get();
                    
        return view('rooms.view', compact('rooms'));
    }

    public function order($id)
    {
        $room = Room::findOrFail($id);

        if ($room->host_id == auth()->id()) {
            return redirect()->route('rooms.view')->with('error', 'You cannot book your own room.');
        }

        return view('rooms.order', compact('room'));
    }

    public function book(Request $request, $roomId)
    {
        $room = Room::findOrFail($roomId);

        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'guests' => 'required|integer|min:1',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('user_pictures', 'public');
        }

        $startDate = new \Carbon\Carbon($request->start_date);
        $endDate = new \Carbon\Carbon($request->end_date);

        $totalDays = -1*($endDate->diffInDays($startDate));

        if ($totalDays <= 0) {
            return back()->withErrors(['end_date' => 'The end date must be after the start date.']);
        }

        $price = $totalDays * $room->price * $request->guests;

        Booking::create([
            'room_id' => $room->id,
            'user_id' => $user->id,
            'status' => 'pending',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'price' => $price,
            'guests' => $request->guests,
            'guest_name' => $user->name,
            'guest_email' => $user->email,
            'guest_phone' => $user->phone,
            'guest_picture' => $picturePath,
        ]);

        return redirect('/')->with('status', 'Your booking is now pending.');
    }
}
