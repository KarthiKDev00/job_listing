<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\Recruiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        $recruiter = Recruiter::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $applications = JobApplication::with([
            'job',
            'jobSeeker.user',
            'jobSeeker.location',
        ])
            ->whereHas('job', function ($query) use ($recruiter) {
                $query->where(
                    'recruiter_id',
                    $recruiter->id
                );
            })
            ->latest()
            ->paginate(10);

        return view(
            'recruiter.applications.index',
            compact('applications')
        );
    }
}