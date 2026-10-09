<?php

namespace App\Jobs;

use App\Mail\JobApplicationMail;
use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendJobApplicationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $applicationId
    ) {
    }

    public function handle(): void
    {
        $application = JobApplication::with([
            'job.recruiter.user',
            'jobSeeker.user',
            'jobSeeker.location',
        ])->find($this->applicationId);

        if (!$application) {
            return;
        }

        $recruiterEmail = $application
            ->job
            ->recruiter
            ->user
            ->email;

        Mail::to($recruiterEmail)
            ->send(new JobApplicationMail($application));
    }
}