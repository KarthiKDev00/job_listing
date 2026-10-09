<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recruiter\JobRequest;
use App\Models\Job;
use App\Models\Location;
use App\Models\Recruiter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JobController extends Controller
{
    /**
     * Display all jobs posted by the logged-in recruiter.
     */
    public function index(): View
    {
        $user = Auth::user();

        $recruiter = Recruiter::where('user_id', $user->id)
            ->firstOrFail();

        $jobs = Job::with('location')
            ->where('recruiter_id', $recruiter->id)
            ->latest()
            ->get();

        return view('recruiter.jobs.index', compact('jobs'));
    }

    /**
     * Show create job form.
     */
    public function create(): View
    {
        $locations = Location::orderBy('name')->get();

        return view('recruiter.jobs.create', compact('locations'));
    }

    /**
     * Store a new job.
     */
    public function store(JobRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $recruiter = Recruiter::where('user_id', $user->id)
            ->firstOrFail();

        Job::create([
            'recruiter_id' => $recruiter->id,
            'location_id' => $request->validated('location_id'),
            'job_title' => $request->validated('job_title'),
            'experience' => $request->validated('experience'),
            'job_description' => $request->validated('job_description'),
            'skills_required' => $request->validated('skills_required'),
            'status' => $request->validated('status'),
        ]);

        return redirect()
            ->route('recruiter.jobs.index')
            ->with('success', 'Job posted successfully.');
    }

    /**
     * Show edit job form.
     */
    public function edit(Job $job): View
    {
        $user = Auth::user();

        $recruiter = Recruiter::where('user_id', $user->id)
            ->firstOrFail();

        if ($job->recruiter_id !== $recruiter->id) {
            abort(403);
        }

        $locations = Location::orderBy('name')->get();

        return view(
            'recruiter.jobs.edit',
            compact('job', 'locations')
        );
    }

    /**
     * Update an existing job.
     */
    public function update(
        JobRequest $request,
        Job $job
    ): RedirectResponse {
        $user = Auth::user();

        $recruiter = Recruiter::where('user_id', $user->id)
            ->firstOrFail();

        if ($job->recruiter_id !== $recruiter->id) {
            abort(403);
        }

        $job->update([
            'location_id' => $request->validated('location_id'),
            'job_title' => $request->validated('job_title'),
            'experience' => $request->validated('experience'),
            'job_description' => $request->validated('job_description'),
            'skills_required' => $request->validated('skills_required'),
            'status' => $request->validated('status'),
        ]);

        return redirect()
            ->route('recruiter.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Delete a job.
     */
    public function destroy(Job $job): RedirectResponse
    {
        $user = Auth::user();

        $recruiter = Recruiter::where('user_id', $user->id)
            ->firstOrFail();

        if ($job->recruiter_id !== $recruiter->id) {
            abort(403);
        }

        $job->delete();

        return redirect()
            ->route('recruiter.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }

    /**
     * Change job status.
     */
    public function status(
        Request $request,
        Job $job
    ): RedirectResponse {
        $user = Auth::user();

        $recruiter = Recruiter::where('user_id', $user->id)
            ->firstOrFail();

        if ($job->recruiter_id !== $recruiter->id) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        $job->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('recruiter.jobs.index')
            ->with('success', 'Job status updated successfully.');
    }
}