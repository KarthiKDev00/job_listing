<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Job Seeker Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background: #111827;
            color: white;
            padding: 25px 15px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 30px;
            padding: 0 10px;
        }

        .sidebar a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 7px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background: #374151;
            color: white;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            margin-bottom: 8px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .card h3 {
            color: #6b7280;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .card .number {
            font-size: 30px;
            font-weight: bold;
        }

        .actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .action-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        .action-card h3 {
            margin-bottom: 10px;
        }

        .action-card p {
            color: #6b7280;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 6px;
        }

        .logout {
            margin-top: 20px;
        }

        @media(max-width: 900px) {
            .cards,
            .actions {
                grid-template-columns: 1fr;
            }

            .sidebar {
                width: 200px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="logo">
            Job Portal
        </div>

        <a href="{{ route('job-seeker.dashboard') }}">
            Dashboard
        </a>

        <a href="{{ route('job-seeker.jobs') }}">
            Find Jobs
        </a>

        <a href="{{ route('job-seeker.applications') }}">
            My Applications
        </a>

        <a href="{{ route('job-seeker.profile') }}">
            My Profile
        </a>

        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    style="
                    width:100%;
                    padding:12px;
                    border:0;
                    border-radius:6px;
                    background:#dc2626;
                    color:white;
                    cursor:pointer;
                    ">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <main class="content">

        <div class="header">

            <h1>
                Welcome, {{ auth()->user()->name }}
            </h1>

            <p>
                Find your next career opportunity.
            </p>

        </div>

        <div class="cards">

            <div class="card">
                <h3>Active Jobs</h3>
                <div class="number">
                    {{ $totalJobs }}
                </div>
            </div>

            <div class="card">
                <h3>My Applications</h3>
                <div class="number">
                    {{ $totalApplications }}
                </div>
            </div>

            <div class="card">
                <h3>Shortlisted</h3>
                <div class="number">
                    {{ $shortlistedApplications }}
                </div>
            </div>

        </div>

        <div class="actions">

            <div class="action-card">

                <h3>Find Jobs</h3>

                <p>
                    Search active jobs based on skills,
                    experience, company and location.
                </p>

                <a class="btn"
                   href="{{ route('job-seeker.jobs') }}">
                    Find Jobs
                </a>

            </div>

            <div class="action-card">

                <h3>My Applications</h3>

                <p>
                    View all jobs you have applied for
                    and check application status.
                </p>

                <a class="btn"
                   href="{{ route('job-seeker.applications') }}">
                    View Applications
                </a>

            </div>

            <div class="action-card">

                <h3>My Profile</h3>

                <p>
                    Update your personal information,
                    skills, resume and photo.
                </p>

                <a class="btn"
                   href="{{ route('job-seeker.profile') }}">
                    Manage Profile
                </a>

            </div>

        </div>

    </main>

</div>

</body>

</html>