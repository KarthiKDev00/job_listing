<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Edit Job</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        textarea {
            min-height: 120px;
        }

        .error {
            color: red;
            margin-top: 5px;
        }

        button,
        .back {
            padding: 11px 18px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #2563eb;
        }

        .back {
            background: #6b7280;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Job</h1>

    <form
        method="POST"
        action="{{ route('recruiter.jobs.update', $job) }}"
    >

        @csrf
        @method('PUT')


        <div class="form-group">

            <label>Job Title</label>

            <input
                type="text"
                name="job_title"
                value="{{ old('job_title', $job->job_title) }}"
            >

            @error('job_title')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>


        <div class="form-group">

            <label>Experience (Years)</label>

            <input
                type="number"
                name="experience"
                min="0"
                step="0.1"
                value="{{ old('experience', $job->experience) }}"
            >

            @error('experience')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>


        <div class="form-group">

            <label>Job Description</label>

            <textarea name="job_description">{{ old('job_description', $job->job_description) }}</textarea>

            @error('job_description')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>


        <div class="form-group">

            <label>Skills Required</label>

            <textarea name="skills_required">{{ old('skills_required', $job->skills_required) }}</textarea>

            @error('skills_required')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>


        <div class="form-group">

            <label>Job Location</label>

            <select name="location_id">

                @foreach($locations as $location)

                    <option
                        value="{{ $location->id }}"
                        {{ old('location_id', $job->location_id) == $location->id ? 'selected' : '' }}
                    >
                        {{ $location->name }}
                    </option>

                @endforeach

            </select>

            @error('location_id')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>


        <div class="form-group">

            <label>Status</label>

            <select name="status">

                <option
                    value="active"
                    {{ old('status', $job->status) === 'active' ? 'selected' : '' }}
                >
                    Active
                </option>

                <option
                    value="inactive"
                    {{ old('status', $job->status) === 'inactive' ? 'selected' : '' }}
                >
                    Inactive
                </option>

            </select>

        </div>


        <button type="submit">
            Update Job
        </button>

        <a
            href="{{ route('recruiter.jobs.index') }}"
            class="back"
        >
            Back
        </a>

    </form>

</div>

</body>
</html>