<?php

namespace App\Http\Requests\Recruiter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()?->role === 'recruiter';
    }

    public function rules(): array
    {
        return [
            'job_title' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'numeric', 'min:0'],
            'job_description' => ['required', 'string'],
            'skills_required' => ['required', 'string'],
            'location_id' => ['required', 'exists:locations,id'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}