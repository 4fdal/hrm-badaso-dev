<?php

namespace Uasoft\Badaso\Module\HRM\Observer;

use Illuminate\Database\Eloquent\Model;

class ExampleObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\Model  $recruitment
     * @return void
     */
    public function created(Model $recruitment)
    {
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\Model  $recruitment
     * @return void
     */
    public function updated(Model $recruitment)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\Model  $recruitment
     * @return void
     */
    public function deleted(Model $recruitment)
    {
        //
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  \App\Models\Model  $recruitment
     * @return void
     */
    public function forceDeleted(Model $recruitment)
    {
        //
    }
}
