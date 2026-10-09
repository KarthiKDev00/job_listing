<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Post Job</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            margin-top: 0;
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
            font-size: 15px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        button,
        .back {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        button {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #6b7280;
            color: white;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Post New Job</h1>

    <form method="POST" action="{{ route('recruiter.jobs.store') }}">
        @csrf

        <div class="form-group">
            <label>Job Title</label>

            <input
                type="text"
                name="job_title"
                value="{{ old('job_title') }}"
                placeholder="Enter job title"
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
                value="{{ old('experience') }}"
                min="0"
                step="0.1"
                placeholder="Example: 2"
            >

            @error('experience')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label>Job Description</label>

            <textarea
                name="job_description"
                placeholder="Enter job description"
            >{{ old('job_description') }}</textarea>

            @error('job_description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label>Skills Required</label>

            <textarea
                name="skills_required"
                placeholder="Example: PHP, Laravel, MySQL, JavaScript"
            >{{ old('skills_required') }}</textarea>

            @error('skills_required')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label>Job Location</label>

            <select name="location_id">

                <option value="">Select Location</option>

                @foreach($locations as $location)

                    <option
                        value="{{ $location->id }}"
                        {{ old('location_id') == $location->id ? 'selected' : '' }}
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

                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="buttons">

            <button type="submit">
                Create Job
            </button>

            <a
                href="{{ route('recruiter.jobs.index') }}"
                class="back"
            >
                Back
            </a>

        </div>

    </form>

</div>

</body>
</html>