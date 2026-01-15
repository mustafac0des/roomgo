<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\ChatController;

Auth::routes();

Route::get('/landing', function () {
    return view('landing');
});

Route::get('/', [RoomController::class, 'bookings'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile/manage', function () {
        return view('profile.manage', ['user' => Auth::user()]);
    });


    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/rooms', [RoomController::class, 'stores'])->name('rooms.stores');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::get('/rooms/manage', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/edit/{id}', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.delete');
    
    Route::get('/rooms/view', [RoomController::class, 'availableRooms'])->name('rooms.view');
    Route::post('/rooms/book/{id}', [RoomController::class, 'book'])->name('rooms.book');
    Route::get('/rooms/order/{id}', [RoomController::class, 'order'])->name('rooms.order');
    Route::put('/bookings/{id}/status', [RoomController::class, 'updateBookingStatus'])->name('rooms.updateBookingStatus');
    
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'chat'])->name('chat');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('users', [UsersController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::get('rooms', [AdminRoomController::class, 'index'])->name('rooms.index');
    Route::get('rooms/create', [AdminRoomController::class, 'create'])->name('rooms.create');
    Route::post('rooms', [AdminRoomController::class, 'store'])->name('rooms.store');
    Route::get('rooms/edit/{id}', [AdminRoomController::class, 'edit'])->name('rooms.edit');
    Route::put('rooms/{id}', [AdminRoomController::class, 'update'])->name('rooms.update');
    Route::delete('rooms/{id}', [AdminRoomController::class, 'destroy'])->name('rooms.destroy');
});
