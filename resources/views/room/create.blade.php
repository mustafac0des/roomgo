@extends('layouts.app')

@section('content')
    <div class="container p-0 mt-5">
        <div class="col col-xl-10 rounded-6 w-100">
            <div class="card rounded-4">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-5">
                        <img src="https://images.unsplash.com/photo-1494475673543-6a6a27143fc8?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                             alt="host room" class="rounded-4 shadow-lg" style="width: 100%; height: 100%; object-fit: cover;" />
                    </div>
                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">
                            <form method="POST" action="{{ route('rooms.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex align-items-center pb-0 mb-3">
                                    <span class="h1 fw-bold mb-0">Host A Room</span>
                                </div>
                                <div class="form-outline mb-1">
                                    <input type="file" id="image" style="color: #9A616D;" class="form-control form-control-md @error('image') is-invalid @enderror" name="image" />
                                    <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="image">Image</label>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-1">
                                    <select id="beds" style="color: #9A616D;" class="form-control form-control-md @error('beds') is-invalid @enderror" name="beds" required>
                                        <option value="1" {{ old('beds') == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ old('beds') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ old('beds') == '3' ? 'selected' : '' }}>3</option>
                                    </select>
                                    <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="beds">Beds</label>
                                    @error('beds')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-1" style="color: #9A616D;">
                                    <select id="washrooms" class="form-control form-control-md @error('washrooms') is-invalid @enderror" name="washrooms" required>
                                        <option value="1" {{ old('washrooms') == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ old('washrooms') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ old('washrooms') == '3' ? 'selected' : '' }}>3</option>
                                    </select>
                                    <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="washrooms">Washrooms</label>
                                    @error('washrooms')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-1">
                                    <input id="guests" type="number" class="form-control form-control-md @error('guests') is-invalid @enderror" name="guests" value="{{ old('guests') }}" required />
                                    <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="guests">Guests</label>
                                    @error('guests')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-1">
                                    <input id="address" type="text" style="color: #9A616D;" class="form-control form-control-md @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required />
                                    <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="address">Address</label>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-1">
                                    <input id="price" type="number" step="0.01" class="form-control form-control-md @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required />
                                    <label class="form-label mt-2 mx-2" style="color: #9A616D;" for="price">Price</label>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-1">
                                    <label for="amenities" class="form-label mt-2 mx-2" style="color: #9A616D;">Amenities</label>
                                    @foreach (['Wi-Fi', 'Parking', 'Pool', 'Gym', 'Breakfast', 'Air Conditioning'] as $amenity)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity }}" {{ in_array($amenity, old('amenities', [])) ? 'checked' : '' }} />
                                            <label class="form-check-label" for="{{ $amenity }}" style="color: #9A616D;">{{ $amenity }}</label>
                                        </div>
                                    @endforeach
                                    @error('amenities')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="pt-1 mb-4">
                                    <button type="submit" class="btn text-light btn-lg rounded-4 shadow-sm" style="background-color: #9A616D;">Add Room</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
