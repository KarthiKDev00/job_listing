@extends('layouts.app')

@section('content')

<style>
    .candidates-page {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0;
        font-size: 28px;
        color: #1f2937;
    }

    .page-header p {
        margin: 6px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .filter-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 22px;
        margin-bottom: 25px;
    }

    .filter-title {
        margin: 0 0 18px;
        font-size: 18px;
        color: #1f2937;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
        align-items: end;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .form-control {
        width: 100%;
        height: 42px;
        padding: 0 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        box-sizing: border-box;
        background: #fff;
    }

    .form-control:focus {
        outline: none;
        border-color: #2563eb;
    }

    .filter-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        height: 42px;
        padding: 0 18px;
        border: none;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary {
        background: #2563eb;
        color: #fff;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
    }

    .alert {
        padding: 13px 16px;
        border-radius: 7px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .table-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
    }

    .table-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h2 {
        margin: 0;
        font-size: 18px;
        color: #1f2937;
    }

    .candidate-count {
        color: #6b7280;
        font-size: 14px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .candidates-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
    }

    .candidates-table th {
        background: #f9fafb;
        color: #4b5563;
        font-size: 13px;
        font-weight: 600;
        text-align: left;
        padding: 14px 16px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .candidates-table td {
        padding: 15px 16px;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        font-size: 14px;
        vertical-align: middle;
    }

    .candidates-table tr:hover {
        background: #f9fafb;
    }

    .candidate-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .candidate-photo {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #e5e7eb;
    }

    .candidate-photo-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-weight: 600;
    }

    .candidate-name {
        font-weight: 600;
        color: #111827;
    }

    .candidate-email {
        margin-top: 3px;
        color: #6b7280;
        font-size: 12px;
    }

    .skills {
        max-width: 220px;
        line-height: 1.5;
    }

    .location {
        white-space: nowrap;
    }

    .resume-btn {
        display: inline-flex;
        align-items: center;
        padding: 7px 12px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .resume-btn:hover {
        background: #dbeafe;
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state h3 {
        margin: 0 0 8px;
        font-size: 18px;
        color: #374151;
    }

    .empty-state p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .pagination-wrapper {
        padding: 18px 20px;
        border-top: 1px solid #e5e7eb;
    }

    @media (max-width: 1100px) {
        .filter-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 700px) {
        .candidates-page {
            padding: 20px 15px;
        }

        .page-header {
            display: block;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            margin-top: 5px;
        }

        .filter-actions .btn {
            flex: 1;
        }
    }
</style>

<div class="candidates-page">

    <div class="page-header">
        <div>
            <h1>Find Candidates</h1>
            <p>Search and filter candidates based on your job requirements.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            Please check the filter values and try again.
        </div>
    @endif

    <div class="filter-card">

        <h2 class="filter-title">Candidate Filters</h2>

        <form method="GET" action="{{ route('recruiter.candidates') }}">

            <div class="filter-grid">

                <div class="form-group">
                    <label for="skills">Skills</label>

                    <input
                        type="text"
                        id="skills"
                        name="skills"
                        class="form-control"
                        placeholder="e.g. Laravel, PHP"
                        value="{{ request('skills') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="notice_period">
                        Notice Period ≤ (Days)
                    </label>

                    <input
                        type="number"
                        id="notice_period"
                        name="notice_period"
                        class="form-control"
                        min="0"
                        placeholder="e.g. 30"
                        value="{{ request('notice_period') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="min_experience">
                        Min Experience ≥ (Years)
                    </label>

                    <input
                        type="number"
                        id="min_experience"
                        name="min_experience"
                        class="form-control"
                        min="0"
                        step="0.1"
                        placeholder="e.g. 2"
                        value="{{ request('min_experience') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="max_experience">
                        Max Experience ≤ (Years)
                    </label>

                    <input
                        type="number"
                        id="max_experience"
                        name="max_experience"
                        class="form-control"
                        min="0"
                        step="0.1"
                        placeholder="e.g. 5"
                        value="{{ request('max_experience') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="location_id">Location</label>

                    <select
                        id="location_id"
                        name="location_id"
                        class="form-control"
                    >
                        <option value="">All Locations</option>

                        @foreach($locations as $location)
                            <option
                                value="{{ $location->id }}"
                                {{ request('location_id') == $location->id ? 'selected' : '' }}
                            >
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="filter-actions" style="margin-top: 15px;">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Search Candidates
                </button>

                <a
                    href="{{ route('recruiter.candidates') }}"
                    class="btn btn-secondary"
                >
                    Clear Filters
                </a>

            </div>

        </form>

    </div>

    <div class="table-card">

        <div class="table-header">

            <h2>Candidate List</h2>

            <span class="candidate-count">
                {{ $candidates->total() }} candidate(s)
            </span>

        </div>

        @if($candidates->count() > 0)

            <div class="table-wrapper">

                <table class="candidates-table">

                    <thead>
                        <tr>
                            <th>Candidate</th>
                            <th>Phone</th>
                            <th>Experience</th>
                            <th>Notice Period</th>
                            <th>Skills</th>
                            <th>Location</th>
                            <th>Resume</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($candidates as $candidate)

                            <tr>

                                <td>
                                    <div class="candidate-info">

                                        @if($candidate->photo)

                                            <img
                                                src="{{ asset('storage/' . $candidate->photo) }}"
                                                alt="{{ $candidate->user->name }}"
                                                class="candidate-photo"
                                            >

                                        @else

                                            <div class="candidate-photo-placeholder">
                                                {{ strtoupper(substr($candidate->user->name, 0, 1)) }}
                                            </div>

                                        @endif

                                        <div>
                                            <div class="candidate-name">
                                                {{ $candidate->user->name }}
                                            </div>

                                            <div class="candidate-email">
                                                {{ $candidate->user->email }}
                                            </div>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    {{ $candidate->phone }}
                                </td>

                                <td>
                                    {{ number_format($candidate->experience, 1) }} Years
                                </td>

                                <td>
                                    {{ $candidate->notice_period }} Days
                                </td>

                                <td>
                                    <div class="skills">
                                        {{ $candidate->skills }}
                                    </div>
                                </td>

                                <td>
                                    <span class="location">
                                        {{ $candidate->location->name ?? '-' }}
                                    </span>
                                </td>

                                <td>

                                    @if($candidate->resume)

                                        <a
                                            href="{{ asset('storage/' . $candidate->resume) }}"
                                            download
                                            class="resume-btn"
                                        >
                                            Download Resume
                                        </a>

                                    @else

                                        <span>-</span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            @if($candidates->hasPages())

                <div class="pagination-wrapper">
                    {{ $candidates->links() }}
                </div>

            @endif

        @else

            <div class="empty-state">

                <h3>No Candidates Found</h3>

                <p>
                    No candidates match the selected filters.
                    Try changing the search criteria.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection