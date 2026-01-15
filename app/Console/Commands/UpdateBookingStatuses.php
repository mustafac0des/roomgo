<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateBookingStatuses extends Command
{
    protected $signature = 'bookings:update-statuses';

    protected $description = 'Update booking statuses based on the end_date.';


    public function handle()
    {
        $currentDate = Carbon::now();

        $occupiedBookings = Booking::where('status', 'occupied')
            ->where('end_date', '<', $currentDate)
            ->get();

        foreach ($occupiedBookings as $booking) {
            $booking->status = 'completed';
            $booking->save();
            $this->info('Booking ' . $booking->id . 'completed');
        }

        $pendingBookings = Booking::where('status', 'pending')
            ->where('end_date', '<', $currentDate)
            ->get();

        foreach ($pendingBookings as $booking) {
            $booking->status = 'rejected';
            $booking->save();
            $this->info('Booking ' . $booking->id . 'rejected.');
        }
    }
}