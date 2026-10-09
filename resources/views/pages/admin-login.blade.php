<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login | School Website</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            color-scheme: light;
            font-family: "Segoe UI", Arial, sans-serif;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            color: #20312d;
            background: #f3f7f5;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(ellipse at 12% 70%, rgba(8, 118, 83, .08), transparent 34rem),
                #f3f7f5;
        }

        a {
            color: inherit;
        }

        .login-topbar {
            min-height: 40px;
            background: #064b38;
            color: rgba(255, 255, 255, .94);
        }

        .login-topbar-inner,
        .login-header-inner,
        .login-footer-inner {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
        }

        .login-topbar-inner {
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            font-size: 12px;
        }

        .login-topbar-title {
            font-weight: 600;
        }

        .login-header {
            background: #fff;
            border-bottom: 1px solid #e2e9e6;
        }

        .login-header-inner {
            min-height: 102px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .school-brand {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 14px;
            color: inherit;
            text-decoration: none;
        }

        .school-logo,
        .school-logo-placeholder {
            width: 66px;
            height: 66px;
            flex: 0 0 66px;
            border: 1px solid #e1ebe6;
            border-radius: 50%;
            background: #eaf4ef;
            object-fit: contain;
        }

        .school-logo-placeholder {
            display: grid;
            place-items: center;
            color: #087653;
            font-size: 25px;
            font-weight: 900;
        }

        .school-name {
            margin: 0;
            color: #075e45;
            font-size: clamp(18px, 2.4vw, 25px);
            font-weight: 900;
            line-height: 1.35;
        }

        .home-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid #d5e4dd;
            border-radius: 5px;
            color: #075e45;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            transition: background .2s ease, color .2s ease, border-color .2s ease;
        }

        .home-link:hover {
            border-color: #075e45;
            background: #075e45;
            color: #fff;
        }

        .login-main {
            width: min(1000px, calc(100% - 40px));
            min-height: calc(100vh - 204px);
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(340px, .88fr);
            align-items: center;
            padding: 54px 0;
        }

        .welcome-panel {
            position: relative;
            min-height: 445px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            padding: 42px;
            border-radius: 8px 0 0 8px;
            background:
                radial-gradient(circle at 90% 8%, rgba(255, 255, 255, .13), transparent 14rem),
                linear-gradient(145deg, #087653, #064b38);
            color: #fff;
            box-shadow: 0 18px 45px rgba(15, 69, 52, .14);
        }

        .welcome-panel::after {
            position: absolute;
            right: -86px;
            bottom: -130px;
            width: 300px;
            height: 300px;
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 50%;
            content: "";
            box-shadow: 0 0 0 32px rgba(255, 255, 255, .035), 0 0 0 70px rgba(255, 255, 255, .025);
        }

        .welcome-copy,
        .welcome-footer {
            position: relative;
            z-index: 1;
        }

        .welcome-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 18px;
            color: #d3f2e2;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .welcome-kicker::before {
            width: 22px;
            height: 2px;
            background: #a8dec2;
            content: "";
        }

        .welcome-title {
            max-width: 420px;
            margin: 0;
            font-size: clamp(29px, 4vw, 42px);
            font-weight: 900;
            line-height: 1.3;
        }

        .welcome-description {
            max-width: 390px;
            margin: 18px 0 0;
            color: rgba(255, 255, 255, .82);
            font-size: 14px;
            line-height: 1.9;
        }

        .welcome-footer {
            margin: 38px 0 0;
            color: rgba(255, 255, 255, .72);
            font-size: 12px;
        }

        .form-panel {
            min-height: 445px;
            display: flex;
            align-items: center;
            padding: 38px;
            border: 1px solid #e3ebe7;
            border-left: 0;
            border-radius: 0 8px 8px 0;
            background: #fff;
            box-shadow: 0 18px 45px rgba(24, 57, 45, .08);
        }

        .form-content {
            width: 100%;
        }

        .form-eyebrow {
            margin: 0 0 7px;
            color: #087653;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .form-title {
            margin: 0;
            color: #173b30;
            font-size: 28px;
            font-weight: 900;
            line-height: 1.35;
        }

        .form-description {
            margin: 8px 0 26px;
            color: #71807a;
            font-size: 13px;
            line-height: 1.7;
        }

        .login-form {
            display: grid;
            gap: 18px;
        }

        .field-label {
            display: block;
            margin-bottom: 7px;
            color: #344740;
            font-size: 13px;
            font-weight: 800;
        }

        .field-input {
            width: 100%;
            height: 46px;
            padding: 0 13px;
            border: 1px solid #d9e3de;
            border-radius: 5px;
            outline: none;
            background: #fff;
            color: #20312d;
            font: inherit;
            font-size: 13px;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .field-input::placeholder {
            color: #9aa6a0;
        }

        .field-input:focus {
            border-color: #087653;
            box-shadow: 0 0 0 3px rgba(8, 118, 83, .12);
        }

        .field-error {
            margin: 6px 0 0;
            color: #b42318;
            font-size: 12px;
        }

        .password-heading,
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .password-heading .field-label {
            margin-bottom: 7px;
        }

        .forgot-link {
            margin-bottom: 7px;
            color: #087653;
            font-size: 11px;
            font-weight: 800;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .remember-option {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #596761;
            font-size: 12px;
            cursor: pointer;
        }

        .remember-option input {
            width: 15px;
            height: 15px;
            margin: 0;
            accent-color: #087653;
        }

        .submit-button {
            min-height: 47px;
            width: 100%;
            border: 1px solid #075e45;
            border-radius: 5px;
            background: #075e45;
            color: #fff;
            font: inherit;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: background .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .submit-button:hover {
            transform: translateY(-1px);
            background: #064b38;
            box-shadow: 0 6px 15px rgba(7, 94, 69, .2);
        }

        .submit-button:focus-visible,
        .home-link:focus-visible,
        .forgot-link:focus-visible {
            outline: 3px solid rgba(8, 118, 83, .35);
            outline-offset: 3px;
        }

        .login-footer {
            padding: 15px 20px;
            background: #075e45;
            color: rgba(255, 255, 255, .82);
            text-align: center;
            font-size: 11px;
        }

        .login-footer strong {
            color: #fff;
        }

        @media (max-width: 760px) {
            .login-main {
                width: min(520px, calc(100% - 28px));
                min-height: auto;
                grid-template-columns: 1fr;
                padding: 28px 0 36px;
            }

            .welcome-panel {
                min-height: 0;
                padding: 26px;
                border-radius: 8px 8px 0 0;
            }

            .welcome-title {
                font-size: 29px;
            }

            .welcome-footer {
                margin-top: 22px;
            }

            .form-panel {
                min-height: 0;
                padding: 28px 24px;
                border: 1px solid #e3ebe7;
                border-top: 0;
                border-radius: 0 0 8px 8px;
            }
        }

        @media (max-width: 520px) {
            .login-topbar-inner,
            .login-header-inner {
                width: calc(100% - 28px);
            }

            .login-topbar-inner {
                justify-content: center;
            }

            .login-topbar-title {
                display: none;
            }

            .login-header-inner {
                min-height: 86px;
                gap: 10px;
            }

            .school-brand {
                gap: 9px;
            }

            .school-logo,
            .school-logo-placeholder {
                width: 52px;
                height: 52px;
                flex-basis: 52px;
            }

            .school-name {
                font-size: 16px;
            }

            .home-link {
                min-height: 36px;
                padding: 0 10px;
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <div class="login-topbar">
        <div class="login-topbar-inner">
            <span class="login-topbar-title">
                School Administration Portal
            </span>
        </div>
    </div>

    <header class="login-header">
        <div class="login-header-inner">
            <a href="{{ route('home') }}" class="school-brand">
                <span class="school-logo-placeholder" aria-hidden="true">S</span>
                <span class="school-name">
                    School Website
                </span>
            </a>

            <a href="{{ route('home') }}" class="home-link">
                Visit website
            </a>
        </div>
    </header>

    <main class="login-main">
        <section class="welcome-panel" aria-labelledby="welcome-title">
            <div class="welcome-copy">
                <p class="welcome-kicker">Welcome back</p>
                <h1 id="welcome-title" class="welcome-title">
                    Your school, all in one place.
                </h1>
                <p class="welcome-description">
                    Sign in to manage school information, notices, teachers, news and website content.
                </p>
            </div>

            <p class="welcome-footer">
                A simple way to keep your school website up to date.
            </p>
        </section>

        <section class="form-panel" aria-labelledby="login-title">
            <div class="form-content">
                <p class="form-eyebrow">Administration</p>
                <h2 id="login-title" class="form-title">Admin login</h2>
                <p class="form-description">
                    Enter your account details to continue.
                </p>

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <div>
                        <label for="email" class="field-label">
                            Email address
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            class="field-input"
                            placeholder="admin@example.com"
                            @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                        >
                        @error('email')
                            <p id="email-error" class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="password-heading">
                            <label for="password" class="field-label">
                                Password
                            </label>
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                Forgot password?
                            </a>
                        </div>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            class="field-input"
                            placeholder="Enter your password"
                            @error('password') aria-invalid="true" aria-describedby="password-error" @enderror
                        >
                        @error('password')
                            <p id="password-error" class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-options">
                        <label class="remember-option" for="remember">
                            <input id="remember" name="remember" type="checkbox" value="1">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="submit-button">
                        Sign in to dashboard
                    </button>
                </form>
            </div>
        </section>
    </main>

    <footer class="login-footer">
        © {{ date('Y') }}
        <strong>School Website</strong>
        — All Rights Reserved
    </footer>
</body>
</html>
