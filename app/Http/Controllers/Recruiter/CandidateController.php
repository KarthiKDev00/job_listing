<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recruiter\CandidateFilterRequest;
use App\Models\JobSeeker;
use App\Models\Location;
use Illuminate\View\View;

class CandidateController extends Controller
{
    public function index(CandidateFilterRequest $request): View
    {
        $query = JobSeeker::with([
            'user',
            'location',
        ]);

        if ($request->filled('skills')) {
            $query->where(
                'skills',
                'like',
                '%' . $request->skills . '%'
            );
        }

        if ($request->filled('notice_period')) {
            $query->where(
                'notice_period',
                '<=',
                $request->notice_period
            );
        }

        if ($request->filled('min_experience')) {
            $query->where(
                'experience',
                '>=',
                $request->min_experience
            );
        }

        if ($request->filled('max_experience')) {
            $query->where(
                'experience',
                '<=',
                $request->max_experience
            );
        }

        if ($request->filled('location_id')) {
            $query->where(
                'location_id',
                $request->location_id
            );
        }

        $candidates = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $locations = Location::orderBy('name')->get();

        return view(
            'recruiter.candidates.index',
            compact('candidates', 'locations')
        );
    }
}