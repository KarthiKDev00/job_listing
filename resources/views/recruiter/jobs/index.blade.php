@extends('layouts.app')

@section('content')

<style>
    .manage-jobs {
        padding: 32px;
        background: #f5f7fb;
        min-height: 100vh;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .page-header h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
    }

    .page-header p {
        margin: 7px 0 0;
        font-size: 14px;
        color: #6b7280;
    }

    .add-job-btn {
        display: inline-block;
        padding: 11px 18px;
        border-radius: 7px;
        background: #2563eb;
        color: #ffffff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .add-job-btn:hover {
        background: #1d4ed8;
    }

    .message {
        padding: 13px 16px;
        margin-bottom: 20px;
        border-radius: 7px;
        font-size: 14px;
    }

    .success-message {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #047857;
    }

    .error-message {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
    }

    .jobs-container {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
    }

    .table-scroll {
        width: 100%;
        overflow-x: auto;
    }

    .jobs-table {
        width: 100%;
        min-width: 1000px;
        border-collapse: collapse;
    }

    .jobs-table th {
        padding: 15px 18px;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #4b5563;
        white-space: nowrap;
    }

    .jobs-table td {
        padding: 17px 18px;
        border-bottom: 1px solid #f0f1f3;
        font-size: 14px;
        color: #374151;
        vertical-align: middle;
    }

    .jobs-table tbody tr:hover {
        background: #fafafa;
    }

    .jobs-table tbody tr:last-child td {
        border-bottom: none;
    }

    .job-title {
        font-weight: 600;
        color: #111827;
    }

    .description {
        max-width: 260px;
        line-height: 1.5;
        color: #6b7280;
    }

    .skills {
        max-width: 180px;
        line-height: 1.5;
    }

    .status {
        display: inline-block;
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-active {
        background: #dcfce7;
        color: #15803d;
    }

    .status-inactive {
        background: #fee2e2;
        color: #b91c1c;
    }

    .actions {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .edit-btn,
    .delete-btn {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 6px;
        border: none;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .edit-btn {
        background: #eff6ff;
        color: #2563eb;
    }

    .edit-btn:hover {
        background: #dbeafe;
    }

    .delete-btn {
        background: #fef2f2;
        color: #dc2626;
    }

    .delete-btn:hover {
        background: #fee2e2;
    }

    .status-form {
        margin: 0;
    }

    .status-select {
        height: 34px;
        padding: 0 9px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #ffffff;
        color: #374151;
        font-size: 13px;
        cursor: pointer;
        outline: none;
    }

    .status-select:focus {
        border-color: #2563eb;
    }

    .empty-box {
        text-align: center;
        padding: 65px 20px;
    }

    .empty-box h3 {
        margin: 0 0 8px;
        font-size: 18px;
        color: #374151;
    }

    .empty-box p {
        margin: 0 0 20px;
        color: #6b7280;
        font-size: 14px;
    }

    .pagination-box {
        padding: 18px;
        border-top: 1px solid #e5e7eb;
    }

    @media (max-width: 768px) {
        .manage-jobs {
            padding: 20px 15px;
        }

        .page-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 18px;
        }

        .page-header h1 {
            font-size: 23px;
        }

        .add-job-btn {
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }
    }
</style>

<div class="manage-jobs">

<div class="page-header">
    <div>
        <h1>Manage Jobs</h1>
        <p>Manage all your job postings from here.</p>
    </div>

    <a
        href="{{ route('recruiter.jobs.create') }}"
        class="add-job-btn"
    >
        + Post New Job
    </a>
</div>

@if(session('success'))
    <div class="message success-message">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="message error-message">
        {{ session('error') }}
    </div>
@endif

<div class="jobs-container">

    @if($jobs->count())

        <div class="table-scroll">
            <table class="jobs-table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Experience</th>
                        <th>Location</th>
                        <th>Skills Required</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($jobs as $job)

                        <tr>
                            <td>
                                <div class="job-title">
                                    {{ $job->job_title }}
                                </div>
                            </td>

                            <td>
                                {{ $job->experience }} Years
                            </td>

                            <td>
                                {{ $job->location->name ?? '-' }}
                            </td>

                            <td>
                                <div class="skills">
                                    {{ $job->skills_required }}
                                </div>
                            </td>

                            <td>
                                <div class="description">
                                    {{ \Illuminate\Support\Str::limit($job->job_description, 90) }}
                                </div>
                            </td>

                            <td>
                                <span class="status status-{{ $job->status }}">
                                    {{ $job->status }}
                                </span>
                            </td>

                            <td>
                                <div class="actions">

                                    <a
                                        href="{{ route('recruiter.jobs.edit', $job) }}"
                                        class="edit-btn"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('recruiter.jobs.destroy', $job) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this job?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-btn"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                    <form
                                        action="{{ route('recruiter.jobs.status', $job) }}"
                                        method="POST"
                                        class="status-form"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <select
                                            name="status"
                                            class="status-select"
                                            onchange="this.form.submit()"
                                        >
                                            <option
                                                value="active"
                                                {{ $job->status === 'active' ? 'selected' : '' }}
                                            >
                                                Active
                                            </option>

                                            <option
                                                value="inactive"
                                                {{ $job->status === 'inactive' ? 'selected' : '' }}
                                            >
                                                Inactive
                                            </option>
                                        </select>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

        @if(method_exists($jobs, 'links'))
            <div class="pagination-box">
                {{ $jobs->links() }}
            </div>
        @endif

    @else

        <div class="empty-box">
            <h3>No Jobs Posted</h3>
            <p>You haven't created any job postings yet.</p>

            <a
                href="{{ route('recruiter.jobs.create') }}"
                class="add-job-btn"
            >
                + Post New Job
            </a>
        </div>

    @endif

</div>


</div>

@endsection
