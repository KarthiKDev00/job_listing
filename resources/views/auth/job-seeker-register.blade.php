<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Job Seeker Registration</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        h2 {
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Job Seeker Registration</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('job-seeker.register.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label>Name</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="form-group">
            <label>Password</label>
            <input
                type="password"
                name="password"
                required
            >
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input
                type="password"
                name="password_confirmation"
                required
            >
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                required
            >
        </div>

        <div class="form-group">
            <label>Experience (Years)</label>
            <input
                type="number"
                name="experience"
                min="0"
                step="0.1"
                value="{{ old('experience') }}"
                required
            >
        </div>

        <div class="form-group">
            <label>Notice Period (Days)</label>
            <input
                type="number"
                name="notice_period"
                min="0"
                value="{{ old('notice_period') }}"
                required
            >
        </div>

        <div class="form-group">
            <label>Skills</label>
            <textarea
                name="skills"
                required
            >{{ old('skills') }}</textarea>
        </div>

        <div class="form-group">
            <label>Job Location</label>

            <select name="location_id" required>
                <option value="">Select Location</option>

                @foreach ($locations as $location)
                    <option
                        value="{{ $location->id }}"
                        {{ old('location_id') == $location->id ? 'selected' : '' }}
                    >
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Resume</label>
            <input
                type="file"
                name="resume"
                accept=".pdf,.doc,.docx"
                required
            >
        </div>

        <div class="form-group">
            <label>Photo</label>
            <input
                type="file"
                name="photo"
                accept=".jpg,.jpeg,.png"
                required
            >
        </div>

        <button type="submit">
            Register
        </button>

    </form>

</div>

</body>
</html>