<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Profile</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 30px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top h1 {
            margin: 0;
        }

        .top a {
            background: #111827;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            display: inline-block;
            font-size: 14px;
            line-height: 1.5;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        .field {
            margin-bottom: 18px;
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
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
        }

        .photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .btn {
            background: #2563eb;
            color: white;
            border: 0;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="top">

        <h1>My Profile</h1>

        <a href="{{ route('job-seeker.dashboard') }}">
            Dashboard
        </a>

    </div>

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card">

        <form
            method="POST"
            action="{{ route('job-seeker.profile.update') }}"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @if($jobSeeker->photo)

                <img
                    class="photo"
                    src="{{ asset('storage/' . $jobSeeker->photo) }}"
                    alt="Profile Photo">

            @endif

            <div class="field">

                <label>Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $jobSeeker->user->name) }}">

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="field">

                <label>Email</label>

                <input
                    type="email"
                    value="{{ $jobSeeker->user->email }}"
                    disabled>

            </div>

            <div class="field">

                <label>Phone</label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $jobSeeker->phone) }}">

                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="field">

                <label>Experience (Years)</label>

                <input
                    type="number"
                    step="0.1"
                    min="0"
                    name="experience"
                    value="{{ old('experience', $jobSeeker->experience) }}">

            </div>

            <div class="field">

                <label>Notice Period (Days)</label>

                <input
                    type="number"
                    min="0"
                    name="notice_period"
                    value="{{ old('notice_period', $jobSeeker->notice_period) }}">

            </div>

            <div class="field">

                <label>Skills</label>

                <textarea
                    name="skills">{{ old('skills', $jobSeeker->skills) }}</textarea>

            </div>

            <div class="field">

                <label>Job Location</label>

                <select name="location_id">

                    @foreach($locations as $location)

                        <option
                            value="{{ $location->id }}"
                            {{ $jobSeeker->location_id == $location->id ? 'selected' : '' }}>

                            {{ $location->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="field">

                <label>Update Photo</label>

                <input
                    type="file"
                    name="photo"
                    accept=".jpg,.jpeg,.png">

            </div>

            <div class="field">

                <label>Update Resume</label>

                <input
                    type="file"
                    name="resume"
                    accept=".pdf,.doc,.docx">

            </div>

            <button class="btn">
                Update Profile
            </button>

        </form>

    </div>

</div>

</body>

</html>