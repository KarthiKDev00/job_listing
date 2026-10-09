<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recruiter Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #1f2937;
            padding: 25px 15px;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            padding: 0 10px;
        }

        .menu a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 8px;
            border-radius: 6px;
        }

        .menu a:hover {
            background: #374151;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        .header {
            background: white;
            padding: 20px 25px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0 0 8px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            text-decoration: none;
            color: #111827;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .card h3 {
            margin-top: 0;
        }

        .logout {
            width: 100%;
            border: none;
            background: #dc2626;
            color: white;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <div class="logo">
            Job Listing Panel
        </div>

        <div class="menu">

            <a href="{{ route('recruiter.dashboard') }}">
                Dashboard
            </a>

            <a href="{{ route('recruiter.jobs.create') }}">
                Post Job
            </a>

            <a href="{{ route('recruiter.jobs.index') }}">
                Manage Jobs
            </a>

            <a href="{{ route('recruiter.candidates') }}">
                Find Candidates
            </a>

            <a href="{{ route('recruiter.applications') }}">
                Applied Jobs
            </a>

            <a href="{{ route('recruiter.profile') }}">
                Profile
            </a>

        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="logout">
                Logout
            </button>
        </form>

    </div>


    <div class="content">

        <div class="header">

            <h1>Recruiter Dashboard</h1>

            <p>
                Welcome, {{ auth()->user()->name }}
            </p>

        </div>


        <div class="cards">

            <a href="{{ route('recruiter.jobs.create') }}" class="card">
                <h3>Post Job</h3>
                <p>Create a new job posting.</p>
            </a>

            <a href="{{ route('recruiter.jobs.index') }}" class="card">
                <h3>Manage Jobs</h3>
                <p>View, edit and delete your jobs.</p>
            </a>

            <a href="{{ route('recruiter.candidates') }}" class="card">
                <h3>Find Candidates</h3>
                <p>Search candidates using filters.</p>
            </a>

            <a href="{{ route('recruiter.applications') }}" class="card">
                <h3>Applied Jobs</h3>
                <p>View candidates who applied.</p>
            </a>

        </div>

    </div>

</body>
</html>