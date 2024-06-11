<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Customer;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    // public function created(User $user): void
    // {
    //     if(!$user->is_man){
    //         $c = new Customer;
    //         $c->user_id = $user->id;
    //         $c->save();
    //     }
    // }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
