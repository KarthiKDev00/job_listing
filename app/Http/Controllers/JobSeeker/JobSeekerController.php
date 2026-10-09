<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobSeeker\ProfileUpdateRequest;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobSeeker;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Jobs\SendJobApplicationMail;

class JobSeekerController extends Controller
{
    public function dashboard(): View
    {
        $userId = Auth::id();

        $jobSeeker = JobSeeker::where(
            'user_id',
            $userId
        )->firstOrFail();

        $totalJobs = Job::where(
            'status',
            'active'
        )->count();

        $totalApplications = JobApplication::where(
            'job_seeker_id',
            $jobSeeker->id
        )->count();

        $shortlistedApplications = JobApplication::where(
            'job_seeker_id',
            $jobSeeker->id
        )
            ->where(
                'status',
                'shortlisted'
            )
            ->count();

        return view(
            'job-seeker.dashboard',
            compact(
                'jobSeeker',
                'totalJobs',
                'totalApplications',
                'shortlistedApplications'
            )
        );
    }

    public function jobs(Request $request): View
    {
        $jobs = Job::with([
            'recruiter',
            'location',
        ])
            ->where(
                'status',
                'active'
            );

        /*
        |--------------------------------------------------------------------------
        | Skills Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('skills')) {

            $jobs->where(
                'skills_required',
                'like',
                '%' . $request->input('skills') . '%'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Company Name Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('company_name')) {

            $jobs->whereHas(
                'recruiter',
                function ($query) use ($request) {

                    $query->where(
                        'company_name',
                        'like',
                        '%' . $request->input('company_name') . '%'
                    );
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Minimum Experience Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('min_experience')) {

            $jobs->where(
                'experience',
                '>=',
                $request->input('min_experience')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Maximum Experience Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('max_experience')) {

            $jobs->where(
                'experience',
                '<=',
                $request->input('max_experience')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Location Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('location_id')) {

            $jobs->where(
                'location_id',
                $request->input('location_id')
            );
        }

        $jobs = $jobs
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $locations = Location::orderBy(
            'name'
        )->get();

        $jobSeeker = JobSeeker::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $appliedJobIds = JobApplication::where(
            'job_seeker_id',
            $jobSeeker->id
        )
            ->pluck('job_id')
            ->toArray();

        return view(
            'job-seeker.jobs.index',
            compact(
                'jobs',
                'locations',
                'appliedJobIds'
            )
        );
    }


    public function applications(): View
    {
        $jobSeeker = JobSeeker::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $applications = JobApplication::with([
            'job.recruiter',
            'job.location',
            'jobSeeker',
        ])
            ->where(
                'job_seeker_id',
                $jobSeeker->id
            )
            ->latest()
            ->paginate(10);

        return view(
            'job-seeker.applications.index',
            compact('applications')
        );
    }

    public function profile(): View
    {
        $jobSeeker = JobSeeker::with([
            'user',
            'location',
        ])
            ->where(
                'user_id',
                Auth::id()
            )
            ->firstOrFail();

        $locations = Location::orderBy(
            'name'
        )->get();

        return view(
            'job-seeker.profile',
            compact(
                'jobSeeker',
                'locations'
            )
        );
    }

    public function updateProfile(
        ProfileUpdateRequest $request
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Get Logged-in User ID
        |--------------------------------------------------------------------------
        */

        $userId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Get Job Seeker
        |--------------------------------------------------------------------------
        */

        $jobSeeker = JobSeeker::where(
            'user_id',
            $userId
        )->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Get Validated Data
        |--------------------------------------------------------------------------
        */

        $data = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | Get Actual User Model
        |--------------------------------------------------------------------------
        |
        | Auth::user() IDE warning avoid பண்ணுவதற்காக
        | User model-ஐ direct query செய்கிறோம்.
        |
        */

        $user = User::where(
            'id',
            $userId
        )->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Update User Name
        |--------------------------------------------------------------------------
        */

        $user->update([
            'name' => $data['name'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload New Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            if (
                $jobSeeker->photo
                && Storage::disk('public')->exists(
                    $jobSeeker->photo
                )
            ) {
                Storage::disk('public')->delete(
                    $jobSeeker->photo
                );
            }

            $data['photo'] = $request
                ->file('photo')
                ->store(
                    'photos',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Upload New Resume
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('resume')) {

            if (
                $jobSeeker->resume
                && Storage::disk('public')->exists(
                    $jobSeeker->resume
                )
            ) {
                Storage::disk('public')->delete(
                    $jobSeeker->resume
                );
            }

            $data['resume'] = $request
                ->file('resume')
                ->store(
                    'resumes',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Remove User Fields
        |--------------------------------------------------------------------------
        |
        | name users table-க்கு மட்டும்.
        | JobSeeker table-க்கு name column இல்லை.
        |
        */

        unset($data['name']);

        /*
        |--------------------------------------------------------------------------
        | Update Job Seeker
        |--------------------------------------------------------------------------
        */

        $jobSeeker->update($data);

        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }

    public function apply(Job $job): RedirectResponse
    {
        if ($job->status !== 'active') {
            return back()->with(
                'error',
                'This job is no longer active.'
            );
        }

        $jobSeeker = JobSeeker::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $alreadyApplied = JobApplication::where(
            'job_id',
            $job->id
        )
            ->where(
                'job_seeker_id',
                $jobSeeker->id
            )
            ->exists();

        if ($alreadyApplied) {
            return back()->with(
                'error',
                'You have already applied for this job.'
            );
        }

        $application = JobApplication::create([
            'job_id' => $job->id,
            'job_seeker_id' => $jobSeeker->id,
            'status' => 'applied',
        ]);

        SendJobApplicationMail::dispatch(
            $application->id
        );

        return redirect()
            ->route('job-seeker.applications')
            ->with(
                'success',
                'Job applied successfully. Your application has been sent to the recruiter.'
            );
    }
}
