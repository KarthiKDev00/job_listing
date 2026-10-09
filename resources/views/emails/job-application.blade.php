@component('mail::message')

# New Job Application

You have received a new application for the following job.

**Job Title:** {{ $application->job->job_title }}

## Candidate Details

**Name:** {{ $application->jobSeeker->user->name }}

**Email:** {{ $application->jobSeeker->user->email }}

**Phone:** {{ $application->jobSeeker->phone }}

**Experience:** {{ number_format($application->jobSeeker->experience, 1) }} Years

**Notice Period:** {{ $application->jobSeeker->notice_period }} Days

**Skills:** {{ $application->jobSeeker->skills }}

**Location:** {{ $application->jobSeeker->location->name ?? '-' }}

The candidate has applied for your job posting.

Thanks,<br>
{{ config('app.name') }}

@endcomponent