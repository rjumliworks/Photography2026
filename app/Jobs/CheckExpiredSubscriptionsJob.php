<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CheckExpiredSubscriptionsJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $today = Carbon::now();

        Subscription::whereDate('end', '<', $today)
            ->where('status_id', '!=', 4)
            ->update(['status_id' => 4]);
    }
}
