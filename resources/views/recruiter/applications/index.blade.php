@extends('layouts.app')

@section('content')

<style>
    .applications-page {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
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
        background: #ffffff;
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

    .application-count {
        color: #6b7280;
        font-size: 14px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .applications-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 950px;
    }

    .applications-table th {
        background: #f9fafb;
        color: #4b5563;
        font-size: 13px;
        font-weight: 600;
        text-align: left;
        padding: 14px 16px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .applications-table td {
        padding: 15px 16px;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        font-size: 14px;
        vertical-align: middle;
    }

    .applications-table tr:hover {
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

    .job-title {
        font-weight: 600;
        color: #1f2937;
    }

    .job-location {
        margin-top: 3px;
        color: #6b7280;
        font-size: 12px;
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

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-applied {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-shortlisted {
        background: #dcfce7;
        color: #166534;
    }

    .status-rejected {
        background: #fee2e2;
        color: #991b1b;
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

    @media (max-width: 700px) {
        .applications-page {
            padding: 20px 15px;
        }

        .page-header h1 {
            font-size: 24px;
        }
    }
</style>

<div class="applications-page">

    <div class="page-header">
        <h1>Applied Jobs</h1>
        <p>View candidates who have applied for your job postings.</p>
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

    <div class="table-card">

        <div class="table-header">
            <h2>Job Applications</h2>

            <span class="application-count">
                {{ $applications->total() }} application(s)
            </span>
        </div>

        @if($applications->count() > 0)

            <div class="table-wrapper">

                <table class="applications-table">

                    <thead>
                        <tr>
                            <th>Candidate</th>
                            <th>Experience</th>
                            <th>Phone</th>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Resume</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($applications as $application)

                            @php
                                $candidate = $application->jobSeeker;
                                $job = $application->job;
                            @endphp

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
                                    {{ number_format($candidate->experience, 1) }}
                                    Years
                                </td>

                                <td>
                                    {{ $candidate->phone }}
                                </td>

                                <td>
                                    <div class="job-title">
                                        {{ $job->job_title }}
                                    </div>
                                </td>

                                <td>
                                    {{ $candidate->location->name ?? '-' }}
                                </td>

                                <td>

                                    @if($application->status === 'shortlisted')

                                        <span class="status status-shortlisted">
                                            Shortlisted
                                        </span>

                                    @elseif($application->status === 'rejected')

                                        <span class="status status-rejected">
                                            Rejected
                                        </span>

                                    @else

                                        <span class="status status-applied">
                                            Applied
                                        </span>

                                    @endif

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

            @if($applications->hasPages())

                <div class="pagination-wrapper">
                    {{ $applications->links() }}
                </div>

            @endif

        @else

            <div class="empty-state">

                <h3>No Applications Found</h3>

                <p>
                    No candidates have applied for your jobs yet.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection