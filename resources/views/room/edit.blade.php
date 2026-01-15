@extends('layouts.app')

@section('content')
<div class="container p-0">
    <div class="col col-xl-10 rounded-6 w-100">
        <div class="card rounded-4" style="border-color: #9a616d;">
            <div class="row g-0">
                <div class="col-md-6 col-lg-5">
                    <img src="https://images.unsplash.com/photo-1663625318264-695d2d04f11a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                         alt="Room Image" class="rounded-4 shadow-lg" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
                        <h1 class="fw-bold mb-4">Edit Room</h1>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert" style="background-color: #9a616d; color: white;">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('rooms.update', $room->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-outline mb-3">
                                <input id="address" type="text" class="form-control form-control-md @error('address') is-invalid @enderror" name="address" value="{{ old('address', $room->address) }}" required autocomplete="address" style="border: 1px solid #9a616d; color: #9a616d;">
                                <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="address">{{ __('Address') }}</label>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-outline mb-3">
                                <input id="beds" type="number" class="form-control form-control-md @error('beds') is-invalid @enderror" name="beds" value="{{ old('beds', $room->beds) }}" required autocomplete="beds" style="border: 1px solid #9a616d; color: #9a616d;">
                                <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="beds">{{ __('Beds') }}</label>
                                @error('beds')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-outline mb-3">
                                <input id="washrooms" type="number" class="form-control form-control-md @error('washrooms') is-invalid @enderror" name="washrooms" value="{{ old('washrooms', $room->washrooms) }}" required autocomplete="washrooms" style="border: 1px solid #9a616d; color: #9a616d;">
                                <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="washrooms">{{ __('Washrooms') }}</label>
                                @error('washrooms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-outline mb-3">
                                <input id="guests" type="number" class="form-control form-control-md @error('guests') is-invalid @enderror" name="guests" value="{{ old('guests', $room->guests) }}" required autocomplete="guests" style="border: 1px solid #9a616d; color: #9a616d;">
                                <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="guests">{{ __('Guests') }}</label>
                                @error('guests')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-outline mb-3">
                                <input id="price" type="number" class="form-control form-control-md @error('price') is-invalid @enderror" name="price" value="{{ old('price', $room->price) }}" required autocomplete="price" style="border: 1px solid #9a616d; color: #9a616d;">
                                <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="price">{{ __('Price') }}</label>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-outline mb-3">
                                @php
                                    $amenities = old('amenities', json_decode($room->amenities, true)) ?? [];
                                    $available_amenities = ['Wi-Fi', 'Parking', 'Pool', 'Gym', 'Breakfast', 'Air Conditioning'];
                                @endphp
                                <div class="d-flex flex-column">
                                    @foreach ($available_amenities as $amenity)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity }}" {{ in_array($amenity, $amenities) ? 'checked' : '' }} style="border: 1px solid #9a616d;">
                                            <label class="form-check-label" style="color: #9a616d;">{{ $amenity }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('amenities')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="pt-1 mb-4">
                                <button type="submit" class="btn text-light btn-lg rounded-4 shadow-sm" style="background-color: #9a616d;">Update Room</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
