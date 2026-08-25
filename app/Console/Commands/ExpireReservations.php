<?php

// app/Console/Commands/ExpireReservations.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;

class ExpireReservations extends Command
{
    protected $signature = 'reservations:expire';
    protected $description = 'Expire pending reservations past their time';

    public function handle()
    {
        $count = Reservation::where('status', 'pending')
            ->where('expires_at', '<', now())
            ->update(['status' => 'expired']);

        $this->info("Expired {$count} reservations.");
    }
}
