@extends('layouts.app')

@section('content')

<style>
    .profile-page {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px;
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

    .profile-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 30px;
    }

    .profile-title {
        margin: 0 0 25px;
        font-size: 20px;
        color: #1f2937;
    }

    .form-group {
        margin-bottom: 20px;
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
        height: 44px;
        padding: 0 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        box-sizing: border-box;
    }

    textarea.form-control {
        height: 110px;
        padding: 12px;
        resize: vertical;
    }

    .form-control:focus {
        outline: none;
        border-color: #2563eb;
    }

    .form-control:disabled {
        background: #f3f4f6;
        color: #6b7280;
        cursor: not-allowed;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .error {
        margin-top: 6px;
        color: #dc2626;
        font-size: 13px;
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

    .profile-actions {
        margin-top: 10px;
        display: flex;
        justify-content: flex-end;
    }

    .btn {
        border: none;
        border-radius: 7px;
        padding: 11px 20px;
        background: #2563eb;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn:hover {
        background: #1d4ed8;
    }

    @media (max-width: 700px) {
        .profile-page {
            padding: 20px 15px;
        }

        .profile-card {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }
</style>

<div class="profile-page">

    <div class="page-header">
        <h1>Recruiter Profile</h1>
        <p>Manage your company profile information.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-card">

        <h2 class="profile-title">Company Information</h2>

        <form
            method="POST"
            action="{{ route('recruiter.profile.update') }}"
        >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="company_name">
                    Company Name
                </label>

                <input
                    type="text"
                    id="company_name"
                    name="company_name"
                    class="form-control"
                    value="{{ old('company_name', $recruiter->company_name) }}"
                >

                @error('company_name')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        class="form-control"
                        value="{{ $recruiter->user->email }}"
                        disabled
                    >
                </div>

                <div class="form-group">
                    <label for="phone">
                        Phone
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone', $recruiter->phone) }}"
                    >

                    @error('phone')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>

            <div class="form-group">
                <label for="address">
                    Address
                </label>

                <textarea
                    id="address"
                    name="address"
                    class="form-control"
                >{{ old('address', $recruiter->address) }}</textarea>

                @error('address')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="profile-actions">
                <button type="submit" class="btn">
                    Update Profile
                </button>
            </div>

        </form>

    </div>

</div>

@endsection