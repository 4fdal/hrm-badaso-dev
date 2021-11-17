<?php

namespace Uasoft\Badaso\Module\HRM\Observer;

use Uasoft\Badaso\Module\HRM\Models\Applicant;
use Uasoft\Badaso\Module\HRM\Models\Job;
use Uasoft\Badaso\Module\HRM\Models\Recruitment;

class ApplicantObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Applicant $applicant
     * @return void
     */
    public function created(Applicant $applicant)
    {
        $this->incrementNoOfRecruitment($applicant);
    }

    /**
     * Increment no of recruitment from job table if create applicant
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Applicant $applicant
     * @return void
     */
    public function incrementNoOfRecruitment(Applicant $applicant)
    {
        // get model job
        $job = $applicant->job;

        // check no of recruitment is not null
        if ($job->no_of_recruitment != null) {
            // increment no of recruitment
            $job->no_of_recruitment = $job->no_of_recruitment + 1;
        } else {
            $job->no_of_recruitment = 1;
        }

        // save job
        $job->save();
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Applicant $applicant
     * @return void
     */
    public function updated(Applicant $applicant)
    {
        //
    }

    /**
     * Handle recruitement done if no to recruitement equla with no of hired employee
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Applicant $applicant
     * @return void
     */

    /**
     * Handle the User "deleted" event.
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Applicant $applicant
     * @return void
     */
    public function deleted(Applicant $applicant)
    {
        $this->decrementNoOfRecruitment($applicant);
    }

    /**
     * Handle the no of recruitment decrement if delete applicant
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Applicant $applicant
     * @return void
     */
    public function decrementNoOfRecruitment(Applicant $applicant)
    {
        // get model job
        $job = $applicant->job;

        // check no of recruitment is not null
        if ($job->no_of_recruitment != null) {
            // increment no of recruitment
            $job->no_of_recruitment = $job->no_of_recruitment - 1;

            if($job->no_of_recruitment < 0) {
                $job->no_of_recruitment = 0;
            }
        } else {
            $job->no_of_recruitment = 0;
        }

        // save job
        $job->save();
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  \Uasoft\Badaso\Module\HRM\Models\Applicant $applicant
     * @return void
     */
    public function forceDeleted(Applicant $applicant)
    {
        //
    }
}
