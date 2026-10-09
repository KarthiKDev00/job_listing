<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JobSeekerRegistrationController extends Controller
{
    public function create()
    {
        $locations = Location::orderBy('name')->get();

        return view('auth.job-seeker-register', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'phone' => ['required', 'string', 'max:20'],
            'experience' => ['required', 'numeric', 'min:0'],
            'notice_period' => ['required', 'integer', 'min:0'],
            'skills' => ['required', 'string'],
            'location_id' => ['required', 'exists:locations,id'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');
        $photoPath = $request->file('photo')->store('photos', 'public');

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'job_seeker',
        ]);

        JobSeeker::create([
            'user_id' => $user->id,
            'location_id' => $validated['location_id'],
            'phone' => $validated['phone'],
            'experience' => $validated['experience'],
            'notice_period' => $validated['notice_period'],
            'skills' => $validated['skills'],
            'resume' => $resumePath,
            'photo' => $photoPath,
        ]);

        Auth::login($user);

        return redirect()->route('job-seeker.dashboard');
    }
}