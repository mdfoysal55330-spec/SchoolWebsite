<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'en' ? 'en' : 'bn' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ app()->getLocale() === 'en' ? 'Admin Login' : 'অ্যাডমিন লগইন' }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f3f7f5;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px 15px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0, 0, 0, .10);
            border: 1px solid #e1e9e5;
        }

        /* HEADER */

        .login-header {
            background: linear-gradient(135deg, #075e45, #087653);
            color: #fff;
            text-align: center;
            padding: 32px 25px 28px;
        }

        .logo-box {
            width: 78px;
            height: 78px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 3px solid rgba(255,255,255,.35);
        }

        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .logo-placeholder {
            font-size: 32px;
        }

        .login-header h1 {
            margin: 0;
            font-size: 23px;
            font-weight: 800;
        }

        .login-header p {
            margin: 8px 0 0;
            font-size: 13px;
            opacity: .9;
        }

        /* BODY */

        .login-body {
            padding: 30px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .input {
            width: 100%;
            height: 47px;
            padding: 0 14px;
            border: 1px solid #d3ddd8;
            border-radius: 7px;
            outline: none;
            font-size: 14px;
            color: #1f2937;
            background: #fff;
            transition: .2s;
        }

        .input:focus {
            border-color: #087653;
            box-shadow: 0 0 0 3px rgba(8,118,83,.10);
        }

        .error {
            margin-top: 6px;
            color: #c62828;
            font-size: 12px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            color: #555;
        }

        .remember input {
            width: 16px;
            height: 16px;
            accent-color: #087653;
        }

        .forgot {
            color: #087653;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        /* LOGIN BUTTON */

        .login-button {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 7px;
            background: #087653;
            color: white;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
            box-shadow: 0 5px 15px rgba(8,118,83,.20);
        }

        .login-button:hover {
            background: #065b41;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(8,118,83,.25);
        }

        /* BACK */

        .back-home {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #087653;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .back-home:hover {
            text-decoration: underline;
        }

        /* FOOTER */

        .login-footer {
            padding: 14px 20px;
            text-align: center;
            background: #fafcfb;
            border-top: 1px solid #edf1ef;
            color: #7b8581;
            font-size: 11px;
        }

        @media (max-width: 480px) {

            .login-page {
                padding: 15px;
            }

            .login-body {
                padding: 24px 20px;
            }

            .login-header {
                padding: 27px 20px 24px;
            }

            .login-header h1 {
                font-size: 20px;
            }

            .remember-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

@php
    $settings = \App\Models\SiteSetting::first();
@endphp

<div class="login-page">

    <div class="login-card">

        {{-- HEADER --}}
        <div class="login-header">

            <div class="logo-box">

                @if($settings?->logo)

                    <img
                        src="{{ asset('storage/' . $settings->logo) }}"
                        alt="School Logo"
                    >

                @else

                    <div class="logo-placeholder">
                        🏫
                    </div>

                @endif

            </div>

            <h1>
                {{ app()->getLocale() === 'en'
                    ? 'Admin Login'
                    : 'অ্যাডমিন লগইন' }}
            </h1>

            <p>
                {{ app()->getLocale() === 'en'
                    ? 'School Administration Panel'
                    : 'স্কুল প্রশাসন প্যানেল' }}
            </p>

        </div>


        {{-- LOGIN FORM --}}
        <div class="login-body">

            <form method="POST" action="{{ route('login') }}">

                @csrf

                {{-- EMAIL --}}
                <div class="field">

                    <label for="email">
                        {{ app()->getLocale() === 'en'
                            ? 'Email Address'
                            : 'ই-মেইল ঠিকানা' }}
                    </label>

                    <input
                        id="email"
                        class="input"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="{{ app()->getLocale() === 'en'
                            ? 'Enter your email address'
                            : 'আপনার ই-মেইল ঠিকানা লিখুন' }}"
                    >

                    @if($errors->get('email'))
                        <div class="error">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                </div>


                {{-- PASSWORD --}}
                <div class="field">

                    <label for="password">
                        {{ app()->getLocale() === 'en'
                            ? 'Password'
                            : 'পাসওয়ার্ড' }}
                    </label>

                    <input
                        id="password"
                        class="input"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="{{ app()->getLocale() === 'en'
                            ? 'Enter your password'
                            : 'আপনার পাসওয়ার্ড লিখুন' }}"
                    >

                    @if($errors->get('password'))
                        <div class="error">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                </div>


                {{-- OPTIONS --}}
                <div class="remember-row">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                        >

                        <span>
                            {{ app()->getLocale() === 'en'
                                ? 'Remember me'
                                : 'আমাকে মনে রাখুন' }}
                        </span>

                    </label>


                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="forgot"
                        >
                            {{ app()->getLocale() === 'en'
                                ? 'Forgot password?'
                                : 'পাসওয়ার্ড ভুলে গেছেন?' }}
                        </a>

                    @endif

                </div>


                {{-- LOGIN --}}
                <button
                    type="submit"
                    class="login-button"
                >
                    🔐
                    {{ app()->getLocale() === 'en'
                        ? 'Login to Admin Panel'
                        : 'অ্যাডমিন প্যানেলে লগইন' }}
                </button>

            </form>


            {{-- BACK TO WEBSITE --}}
            <a
                href="{{ url('/') }}"
                class="back-home"
            >
                ←
                {{ app()->getLocale() === 'en'
                    ? 'Back to Website'
                    : 'ওয়েবসাইটে ফিরে যান' }}
            </a>

        </div>


        {{-- FOOTER --}}
        <div class="login-footer">

            © {{ date('Y') }}

            {{ $settings?->school_name ?? 'School Website' }}

        </div>

    </div>

</div>

</body>
</html>
