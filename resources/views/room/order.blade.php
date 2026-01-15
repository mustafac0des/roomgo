@extends('layouts.app')

@section('content')
<div class="container p-0 mt-5">
    <div class="col col-xl-10 rounded-6 w-100">
        <div class="card rounded-4">
            <div class="row g-0">
                <div class="col-md-6 col-lg-5">
                    <img src="{{ asset('storage/' . $room->image) }}" class="rounded-4 shadow-lg" alt="Room Image" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
                        <h2 class="mb-4" style="color: #9A616D;">Booking Details for Room: {{ $room->address }}</h2>
                        <p class="m-0"><strong>Beds:</strong> {{ $room->beds }}</p>
                        <p class="m-0"><strong>Washrooms:</strong> {{ $room->washrooms }}</p>
                        <p class="m-0"><strong>Guests:</strong> {{ $room->guests }}</p>
                        <p class="m-0"><strong>Price:</strong> ${{ number_format($room->price, 2) }}</p>
                        <p class="m-0"><strong>Amenities:</strong></p>
                        <ul>
                            @foreach(json_decode($room->amenities) as $amenity)
                                <li>{{ $amenity }}</li>
                            @endforeach
                        </ul>
                        <form action="{{ route('rooms.book', $room->id) }}" method="POST">
                            @csrf
                            <div class="form-outline mb-3">
                                <label for="start_date" class="form-label" style="color: #9A616D;">Start Date</label>
                                <input type="date" name="start_date" class="form-control form-control-md @error('start_date') is-invalid @enderror" required />
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-outline mb-3">
                                <label for="end_date" class="form-label" style="color: #9A616D;">End Date</label>
                                <input type="date" name="end_date" class="form-control form-control-md @error('end_date') is-invalid @enderror" required />
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-outline mb-3">
                                <label for="guests" class="form-label" style="color: #9A616D;">Guests</label>
                                <input type="number" name="guests" class="form-control form-control-md @error('guests') is-invalid @enderror" required min="1" />
                                @error('guests')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn text-light btn-lg rounded-4 shadow-sm" style="background-color: #9A616D;">Book Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
