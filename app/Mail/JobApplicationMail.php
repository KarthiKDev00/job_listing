<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public JobApplication $application
    ) {
    }

    public function build()
    {
        return $this
            ->subject(
                'New Job Application - ' .
                $this->application->job->job_title
            )
            ->markdown('emails.job-application');
    }
}