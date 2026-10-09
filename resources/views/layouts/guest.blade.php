
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $settings = \App\Models\SiteSetting::first();
    @endphp

    <title>
        {{ $settings?->school_name ?? config('app.name', 'School Website') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f3f7f5;
            color: #1f2937;
        }

        .guest-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOP BAR */

        .guest-topbar {
            height: 42px;
            background: #064b38;
            color: rgba(255, 255, 255, .92);
            display: flex;
            align-items: center;
        }

        .guest-topbar-inner {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
        }

        .guest-top-title {
            font-weight: 600;
        }

        .guest-language a {
            color: #fff;
            text-decoration: none;
            margin-left: 14px;
            font-weight: 700;
        }

        .guest-language a:hover {
            text-decoration: underline;
        }

        /* MAIN HEADER */

        .guest-header {
            background: #fff;
            border-bottom: 1px solid #e2e9e6;
            padding: 18px 20px;
        }

        .guest-header-inner {
            max-width: 1180px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .school-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            text-align: left;
        }

        .school-logo {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            object-fit: contain;
            border: 2px solid #e1ebe6;
            background: #fff;
        }

        .school-placeholder {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            background: #eaf4ef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
        }

        .school-name {
            color: #075e45;
            font-size: 19px;
            font-weight: 800;
            line-height: 1.35;
        }

        .school-address {
            color: #6b7280;
            font-size: 12px;
            margin-top: 4px;
        }

        /* LOGIN AREA */

        .guest-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 45px 20px 55px;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
        }

        /* FOOTER */

        .guest-footer {
            background: #075e45;
            color: rgba(255,255,255,.85);
            text-align: center;
            padding: 16px 20px;
            font-size: 12px;
        }

        .guest-footer strong {
            color: #fff;
        }

        @media (max-width: 600px) {

            .guest-topbar-inner {
                justify-content: center;
            }

            .guest-top-title {
                display: none;
            }

            .guest-header {
                padding: 15px;
            }

            .school-brand {
                text-align: center;
                flex-direction: column;
                gap: 8px;
            }

            .school-name {
                font-size: 17px;
            }

            .school-address {
                font-size: 11px;
            }

            .guest-content {
                padding: 25px 14px 35px;
            }
        }
    </style>
</head>

<body>

<div class="guest-page">

    {{-- TOP BAR --}}
    <div class="guest-topbar">

        <div class="guest-topbar-inner">

            <div class="guest-top-title">
                {{ app()->getLocale() === 'en'
                    ? 'School Administration Portal'
                    : 'স্কুল প্রশাসন পোর্টাল' }}
            </div>

            <div class="guest-language">

                <a href="{{ route('language.switch', 'bn') }}">
                    বাংলা
                </a>

                <a href="{{ route('language.switch', 'en') }}">
                    English
                </a>

            </div>

        </div>

    </div>


    {{-- SCHOOL HEADER --}}
    <header class="guest-header">

        <div class="guest-header-inner">

            <a href="{{ url('/') }}" style="text-decoration:none;">

                <div class="school-brand">

                    @if($settings?->logo)

                        <img
                            src="{{ asset('storage/' . $settings->logo) }}"
                            class="school-logo"
                            alt="School Logo"
                        >

                    @else

                        <div class="school-placeholder">
                            🏫
                        </div>

                    @endif


                    <div>

                        <div class="school-name">
                            {{ $settings?->school_name ?? 'School Website' }}
                        </div>

                        @if($settings?->address)

                            <div class="school-address">
                                {{ $settings->address }}
                            </div>

                        @endif

                    </div>

                </div>

            </a>

        </div>

    </header>


    {{-- PAGE CONTENT --}}
    <main class="guest-content">

        <div class="login-container">

            {{ $slot }}

        </div>

    </main>


    {{-- FOOTER --}}
    <footer class="guest-footer">

        © {{ date('Y') }}

        <strong>
            {{ $settings?->school_name ?? 'School Website' }}
        </strong>

        —

        {{ app()->getLocale() === 'en'
            ? 'All Rights Reserved'
            : 'সর্বস্বত্ব সংরক্ষিত' }}

    </footer>

</div>

</body>
</html>
