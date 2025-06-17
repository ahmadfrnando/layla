<?php

namespace App\Listeners;

use IlluminateAuthEventsLogout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class UpdateUserInactiveStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Logout $event)
    {
        $user = $event->user;
        DB::table('users')
            ->where('id', $user->id)
            ->update(['is_active' => 0]);

        Log::info("User is_active status after query builder update: ", ['is_active' => $user->is_active]);
    }
}
