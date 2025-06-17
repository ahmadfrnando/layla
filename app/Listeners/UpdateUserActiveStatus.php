<?php

namespace App\Listeners;

use IlluminateAuthEventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateUserActiveStatus
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
    public function handle(Login $event)
    {
        $user = $event->user;

        DB::table('users')
            ->where('id', $user->id)
            ->update(['is_active' => 1]);

        Log::info("User is_active status after query builder update: ", ['is_active' => $user->is_active]);
    }
}
