<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recruiter\ProfileUpdateRequest;
use App\Models\Recruiter;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $recruiter = Recruiter::with('user')
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view(
            'recruiter.profile',
            compact('recruiter')
        );
    }

    public function update(
        ProfileUpdateRequest $request
    ): RedirectResponse {
        $recruiter = Recruiter::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $data = $request->validated();

        $recruiter->update([
            'company_name' => $data['company_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);

        User::where(
            'id',
            Auth::id()
        )->update([
            'name' => $data['company_name'],
        ]);

        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }
}