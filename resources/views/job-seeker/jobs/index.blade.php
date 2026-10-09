<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Find Jobs</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
            color: #1f2937;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top a {
            background: #111827;
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 6px;
        }

        .filter {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
        }

        label {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
        }

        .search-btn {
            background: #2563eb;
            color: white;
            border: 0;
            border-radius: 6px;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        .job {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .job-header {
            display: flex;
            justify-content: space-between;
        }

        .job h2 {
            margin-bottom: 8px;
        }

        .company {
            color: #2563eb;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .details {
            display: flex;
            gap: 20px;
            color: #6b7280;
            margin: 12px 0;
        }

        .skills {
            margin: 15px 0;
        }

        .apply-btn {
            background: #16a34a;
            color: white;
            border: 0;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
        }

        .applied {
            background: #9ca3af;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            display: inline-block;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .pagination {
            margin-top: 25px;
        }

        @media(max-width: 900px) {
            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

    </style>

</head>

<body>

<div class="container">

    <div class="top">

        <h1>Find Jobs</h1>

        <a href="{{ route('job-seeker.dashboard') }}">
            Dashboard
        </a>

    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <div class="filter">

        <form method="GET"
              action="{{ route('job-seeker.jobs') }}">

            <div class="filter-grid">

                <div>
                    <label>Skills</label>

                    <input
                        type="text"
                        name="skills"
                        value="{{ request('skills') }}"
                        placeholder="PHP, Laravel, Node.js">
                </div>

                <div>
                    <label>Company Name</label>

                    <input
                        type="text"
                        name="company_name"
                        value="{{ request('company_name') }}"
                        placeholder="Company">
                </div>

                <div>
                    <label>Min Experience</label>

                    <input
                        type="number"
                        step="0.1"
                        min="0"
                        name="min_experience"
                        value="{{ request('min_experience') }}"
                        placeholder="0">
                </div>

                <div>
                    <label>Max Experience</label>

                    <input
                        type="number"
                        step="0.1"
                        min="0"
                        name="max_experience"
                        value="{{ request('max_experience') }}"
                        placeholder="5">
                </div>

                <div>
                    <label>Location</label>

                    <select name="location_id">

                        <option value="">
                            All Locations
                        </option>

                        @foreach($locations as $location)

                            <option
                                value="{{ $location->id }}"
                                {{ request('location_id') == $location->id ? 'selected' : '' }}>

                                {{ $location->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <button class="search-btn">
                Search Jobs
            </button>

        </form>

    </div>

    @forelse($jobs as $job)

        <div class="job">

            <div class="job-header">

                <div>

                    <h2>
                        {{ $job->job_title }}
                    </h2>

                    <div class="company">
                        {{ $job->recruiter->company_name }}
                    </div>

                </div>

            </div>

            <div class="details">

                <span>
                    Experience:
                    {{ $job->experience }} years
                </span>

                <span>
                    Location:
                    {{ $job->location->name }}
                </span>

            </div>

            <p>
                {{ $job->job_description }}
            </p>

            <div class="skills">

                <strong>Skills Required:</strong>

                {{ $job->skills_required }}

            </div>

            @if(in_array($job->id, $appliedJobIds))

                <span class="applied">
                    Already Applied
                </span>

            @else

                <form
                    method="POST"
                    action="{{ route('job-seeker.jobs.apply', $job) }}">

                    @csrf

                    <button
                        type="submit"
                        class="apply-btn">

                        Apply for Job

                    </button>

                </form>

            @endif

        </div>

    @empty

        <div class="job">

            <h3>
                No jobs found.
            </h3>

            <p>
                Try changing your search filters.
            </p>

        </div>

    @endforelse

    <div class="pagination">

        {{ $jobs->links() }}

    </div>

</div>

</body>

</html>