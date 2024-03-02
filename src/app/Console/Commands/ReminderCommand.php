<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Reservation;
use App\Mail\ReservationNotification;


class ReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reservations = Reservation::with('user','shop')->whereDate('reservation_date', Carbon::today())->get();

        foreach ($reservations as $reservation) {
            $this->sendReservationNotification($reservation);
        }
    }

    protected function sendReservationNotification($reservation)
    {
        Mail::to($reservation->user->email)->send(new ReservationNotification($reservation));
    }

}
