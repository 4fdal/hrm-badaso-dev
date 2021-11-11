<?php

namespace Uasoft\Badaso\Module\HRM\Observer;

use Uasoft\Badaso\Module\HRM\Models\Job;
use Uasoft\Badaso\Module\HRM\Models\Recruitment;

class JobObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Job  $job
     * @return void
     */
    public function created(Job $job)
    {
        // create new requitement
        $recruitment = Recruitment::create([
            'no_of_to_recruit' => $job->no_of_recruitment ?? 1,
            'job_id' => $job->id,
        ]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Job  $job
     * @return void
     */
    public function updated(Job $job)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Job  $job
     * @return void
     */
    public function deleted(Job $job)
    {
        //
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Job  $job
     * @return void
     */
    public function forceDeleted(Job $job)
    {
        //
    }
}
