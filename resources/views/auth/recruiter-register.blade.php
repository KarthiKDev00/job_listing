<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Recruiter Registration</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-bottom: 25px;
            text-align: center;
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
        textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 6px;
            background: #2563eb;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .login {
            text-align: center;
            margin-top: 20px;
        }

        .login a {
            color: #2563eb;
            text-decoration: none;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>
            Recruiter Registration
        </h1>

        <form
            method="POST"
            action="{{ route('recruiter.register.store') }}">

            @csrf

            <div class="field">

                <label>
                    Company Name
                </label>

                <input
                    type="text"
                    name="company_name"
                    value="{{ old('company_name') }}"
                    placeholder="Enter company name">

                @error('company_name')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <div class="field">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter email">

                @error('email')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <div class="field">

                <label>
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="Enter phone number">

                @error('phone')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <div class="field">

                <label>
                    Address
                </label>

                <textarea
                    name="address"
                    placeholder="Enter company address">{{ old('address') }}</textarea>

                @error('address')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <div class="field">

                <label>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter password">

                @error('password')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <div class="field">

                <label>
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm password">

            </div>

            <button
                type="submit"
                class="btn">

                Register

            </button>

        </form>

        <div class="login">

            Already have an account?

            <a href="{{ route('login') }}">
                Login
            </a>

        </div>

    </div>

</div>

</body>

</html>