<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recruiter\RecruiterRegistrationRequest;
use App\Models\Recruiter;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RecruiterRegistrationController extends Controller
{
    public function create(): View
    {
        return view('auth.recruiter-register');
    }

    public function store(
        RecruiterRegistrationRequest $request
    ): RedirectResponse {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['company_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'recruiter',
        ]);

        Recruiter::create([
            'user_id' => $user->id,
            'company_name' => $data['company_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);

        Auth::login($user);

        return redirect()->route('recruiter.dashboard');
    }
}