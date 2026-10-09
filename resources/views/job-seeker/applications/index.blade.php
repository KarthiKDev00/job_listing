<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Applications</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
        }

        .container {
            max-width: 1200px;
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
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            display: inline-block;
            font-size: 14px;
            line-height: 1.5;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f9fafb;
        }

        .status {
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 13px;
        }

        .applied {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .shortlisted {
            background: #dcfce7;
            color: #166534;
        }

        .rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .resume {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 7px 12px;
            border-radius: 5px;
            display: inline-block;
            font-size: 13px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="top">

        <h1>My Applications</h1>

        <a href="{{ route('job-seeker.dashboard') }}">
            Dashboard
        </a>

    </div>

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif

    <table>

        <thead>

        <tr>
            <th>Job Title</th>
            <th>Company</th>
            <th>Experience</th>
            <th>Location</th>
            <th>Status</th>
            <th>Resume</th>
        </tr>

        </thead>

        <tbody>

        @forelse($applications as $application)

            <tr>

                <td>
                    {{ $application->job->job_title }}
                </td>

                <td>
                    {{ $application->job->recruiter->company_name }}
                </td>

                <td>
                    {{ $application->job->experience }} years
                </td>

                <td>
                    {{ $application->job->location->name }}
                </td>

                <td>

                    <span class="status {{ $application->status }}">

                        {{ ucfirst($application->status) }}

                    </span>

                </td>

                <td>

                    @if($application->jobSeeker->resume)

                        <a
                            class="resume"
                            href="{{ asset('storage/' . $application->jobSeeker->resume) }}"
                            target="_blank">

                            Download Resume

                        </a>

                    @else

                        No Resume

                    @endif

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6">
                    You have not applied for any jobs yet.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    <div style="margin-top:20px">

        {{ $applications->links() }}

    </div>

</div>

</body>

</html>