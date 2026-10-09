
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

        .admin-layout {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOP HEADER */

        .admin-top-header {
            background: #075e45;
            color: white;
            min-height: 64px;
            display: flex;
            align-items: center;
        }

        .admin-top-inner {
            width: 100%;
            max-width: 1280px;
            margin: auto;
            padding: 0 24px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-logo {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: contain;
            background: white;
            border: 2px solid rgba(255,255,255,.35);
        }

        .admin-logo-placeholder {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255,255,255,.14);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 20px;
        }

        .admin-school-name {
            font-size: 16px;
            font-weight: 800;
            line-height: 1.3;
        }

        .admin-panel-title {
            font-size: 11px;
            opacity: .82;
            margin-top: 2px;
        }

        .admin-home-button {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 9px 15px;

            background: rgba(255,255,255,.12);
            color: white;

            border: 1px solid rgba(255,255,255,.25);
            border-radius: 6px;

            text-decoration: none;
            font-size: 12px;
            font-weight: 700;

            transition: .2s ease;
        }

        .admin-home-button:hover {
            background: white;
            color: #075e45;
        }

        /* NAVIGATION */

        .admin-navigation {
            background: white;
            border-bottom: 1px solid #dfe8e4;
            box-shadow: 0 2px 6px rgba(0,0,0,.04);
        }

        .admin-navigation-inner {
            max-width: 1280px;
            margin: auto;
            padding: 0 24px;
        }

        /* MAIN CONTENT */

        .admin-main {
            flex: 1;
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;

            padding: 28px 24px 45px;
        }

        /* PAGE HEADER */

        .admin-page-heading {
            margin-bottom: 24px;
        }

        .admin-page-heading h1 {
            margin: 0;

            color: #075e45;

            font-size: 24px;
            font-weight: 800;
        }

        .admin-page-heading p {
            margin: 6px 0 0;

            color: #6b7280;
            font-size: 13px;
        }

        /* FOOTER */

        .admin-footer {
            background: #064b38;
            color: rgba(255,255,255,.82);

            text-align: center;

            padding: 15px 20px;

            font-size: 12px;
        }

        .admin-footer strong {
            color: white;
        }

        /* RESPONSIVE */

        @media (max-width: 700px) {

            .admin-top-inner {
                padding: 0 15px;
            }

            .admin-school-name {
                font-size: 14px;
            }

            .admin-panel-title {
                display: none;
            }

            .admin-home-button {
                padding: 8px 11px;
                font-size: 11px;
            }

            .admin-navigation-inner {
                padding: 0 15px;
            }

            .admin-main {
                padding: 22px 15px 35px;
            }

            .admin-page-heading h1 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

<div class="admin-layout">

    {{-- TOP HEADER --}}
    <header class="admin-top-header">

        <div class="admin-top-inner">

            <div class="admin-brand">

                @if($settings?->logo)

                    <img
                        src="{{ asset('storage/' . $settings->logo) }}"
                        class="admin-logo"
                        alt="School Logo"
                    >

                @else

                    <div class="admin-logo-placeholder">
                        🏫
                    </div>

                @endif

                <div>

                    <div class="admin-school-name">
                        {{ $settings?->school_name ?? 'School Website' }}
                    </div>

                    <div class="admin-panel-title">
                        {{ app()->getLocale() === 'en'
                            ? 'Administration Panel'
                            : 'প্রশাসন প্যানেল' }}
                    </div>

                </div>

            </div>


            <a href="{{ url('/') }}" class="admin-home-button">
                <span>🏠</span>

                {{ app()->getLocale() === 'en'
                    ? 'Visit Website'
                    : 'ওয়েবসাইট দেখুন' }}
            </a>

        </div>

    </header>


    {{-- ADMIN NAVIGATION --}}
    <nav class="admin-navigation">

        <div class="admin-navigation-inner">

            @include('layouts.navigation')

        </div>

    </nav>


    {{-- MAIN CONTENT --}}
    <main class="admin-main">

        {{ $slot }}

    </main>


    {{-- FOOTER --}}
    <footer class="admin-footer">

        © {{ date('Y') }}

        <strong>
            {{ $settings?->school_name ?? 'School Website' }}
        </strong>

        —

        {{ app()->getLocale() === 'en'
            ? 'Administration Panel'
            : 'প্রশাসন প্যানেল' }}

    </footer>

</div>

</body>
</html>
