<?php

namespace App\Http\Requests\Recruiter;

use Illuminate\Foundation\Http\FormRequest;

class CandidateFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null
            && $user->role === 'recruiter';
    }

    public function rules(): array
    {
        return [
            'skills' => ['nullable', 'string', 'max:255'],
            'notice_period' => ['nullable', 'integer', 'min:0'],
            'min_experience' => ['nullable', 'numeric', 'min:0'],
            'max_experience' => ['nullable', 'numeric', 'min:0'],
            'location_id' => ['nullable', 'exists:locations,id'],
        ];
    }
}
