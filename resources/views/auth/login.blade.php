<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Job Listing</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo h1 {
            font-size: 28px;
            color: #2563eb;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .form-group input {
            width: 100%;
            height: 44px;
            padding: 0 13px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 10px 0 22px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            color: #6b7280;
        }

        .remember input {
            width: 15px;
            height: 15px;
        }

        .forgot-password {
            font-size: 13px;
            color: #2563eb;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            height: 45px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-btn:hover {
            background: #1d4ed8;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 25px 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            color: #9ca3af;
            font-size: 12px;
        }

        .register-title {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 14px;
        }

        .register-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .register-btn {
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .job-seeker-btn {
            border: 1px solid #2563eb;
            color: #2563eb;
            background: #ffffff;
        }

        .job-seeker-btn:hover {
            background: #eff6ff;
        }

        .recruiter-btn {
            background: #2563eb;
            color: #ffffff;
        }

        .recruiter-btn:hover {
            background: #1d4ed8;
        }

        .error {
            margin-bottom: 18px;
            padding: 10px 12px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            border-radius: 6px;
            font-size: 13px;
        }

        .success {
            margin-bottom: 18px;
            padding: 10px 12px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            border-radius: 6px;
            font-size: 13px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 25px 20px;
            }

            .register-buttons {
                grid-template-columns: 1fr;
            }

            .remember-row {
                align-items: flex-start;
                gap: 10px;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <div class="logo">
                <h1>Job Listing</h1>
            </div>

            <p class="subtitle">
                Login to your account
            </p>

            @if (session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="form-group">
                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <div class="remember-row">

                    <label class="remember">
                        <input
                            type="checkbox"
                            name="remember"
                        >

                        <span>
                            Remember me
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            class="forgot-password"
                        >
                            Forgot Password?
                        </a>
                    @endif

                </div>

                <button
                    type="submit"
                    class="login-btn"
                >
                    Login
                </button>

            </form>

            <div class="divider">
                <div class="divider-line"></div>
                <span>OR</span>
                <div class="divider-line"></div>
            </div>

            <p class="register-title">
                Don't have an account?
            </p>

            <div class="register-buttons">

                <a
                    href="{{ route('job-seeker.register') }}"
                    class="register-btn job-seeker-btn"
                >
                    Job Seeker
                </a>

                <a
                    href="{{ route('recruiter.register') }}"
                    class="register-btn recruiter-btn"
                >
                    Recruiter
                </a>

            </div>

        </div>

    </div>

</body>
</html>