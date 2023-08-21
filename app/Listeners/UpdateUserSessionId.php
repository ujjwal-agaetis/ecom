<?php

namespace App\Listeners;
use Illuminate\Auth\Events\Login;
use App\Models\Cart;
class UpdateUserSessionId
{
    public function handle(Login $event)
    {
        $user = $event->user; // The authenticated user
        $newSessionId = session()->getId(); // Get the new session ID
        // Update the session ID in the other table
        // Replace 'OtherTableModel' with the actual model name for the other table
        Cart::where('user_id', $user->id)->update(['session_id' => $newSessionId]);
    }
}
