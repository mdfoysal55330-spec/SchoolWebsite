
<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'en' ? 'en' : 'bn' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $settings?->school_name ?? (app()->getLocale() === 'en' ? 'Our School' : 'আমাদের বিদ্যালয়') }}</title>

    @if($settings?->favicon)
        <link rel="icon" href="{{ asset($settings->favicon) }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: "Noto Sans Bengali", "Noto Sans", Arial, sans-serif;
            background: #f4f7f6;
            color: #172033;
        }

        a {
            text-decoration: none;
        }

        .container {
            width: min(1240px, calc(100% - 32px));
            margin: auto;
        }

        /* =========================
           TOP BAR
        ========================= */

        .top-bar {
            background: #063f31;
            color: #fff;
            font-size: 13px;
        }

        .top-bar-inner {
            min-height: 38px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .top-contact {
            display: flex;
            flex-wrap: wrap;
            gap: 22px;
        }

        .top-contact span {
            opacity: .92;
        }

        .top-social {
            display: flex;
            gap: 16px;
        }

        .top-social a {
            color: #fff;
            opacity: .92;
        }

        .top-social a:hover {
            opacity: 1;
        }

        /* =========================
           HEADER
        ========================= */

        .main-header {
            background: #fff;
            border-bottom: 1px solid #e3e8e6;
        }

        .header-inner {
            min-height: 105px;
            display: grid;
            grid-template-columns: 150px 1fr 150px;
            align-items: center;
            gap: 20px;
        }

        /* ADMIN LEFT */

        
        .admin-area {
            display: flex;
            justify-content: flex-start;
        }

        .admin-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            min-width: 132px;
            height: 42px;

            padding: 0 17px;

            background: #ffffff;
            color: #075e45;

            border: 1px solid #075e45;
            border-radius: 6px;

            font-size: 13px;
            font-weight: 800;

            box-shadow: 0 2px 7px rgba(0, 0, 0, .05);

            transition:
                background .2s ease,
                color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;
        }

        .admin-button:hover {
            background: #075e45;
            color: #ffffff;

            box-shadow: 0 5px 14px rgba(7, 94, 69, .18);

            transform: translateY(-1px);
        }

        .admin-icon {
            width: 24px;
            height: 24px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #e8f4ef;
            color: #075e45;

            font-size: 12px;
        }

        .admin-button:hover .admin-icon {
            background: rgba(255,255,255,.18);
            color: #ffffff;
        }


        /* BRAND */

        .school-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            min-width: 0;
            color: inherit;
        }

        .school-logo {
            width: 72px;
            height: 72px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .school-logo-placeholder {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: #e8f4ef;
            color: #087653;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 29px;
            font-weight: 900;
            flex-shrink: 0;
        }

        .school-name {
            margin: 0;
            color: #123c32;
            font-size: clamp(21px, 3vw, 31px);
            line-height: 1.25;
            font-weight: 900;
        }

        .school-address {
            margin: 5px 0 0;
            color: #68767a;
            font-size: 13px;
        }

        /* LANGUAGE */

        .language-area {
            display: flex;
            justify-content: flex-end;
        }

        .language-switch {
            display: inline-flex;
            border: 1px solid #d6dfdc;
            border-radius: 5px;
            overflow: hidden;
            background: #fff;
        }

        .language-switch a {
            padding: 9px 11px;
            color: #38504a;
            font-size: 12px;
            font-weight: 800;
        }

        .language-switch a.active {
            background: #087653;
            color: #fff;
        }

        .language-switch a:hover:not(.active) {
            background: #f0f6f4;
        }

        /* =========================
           NAVIGATION
        ========================= */

        .main-nav {
            background: #fff;
            border-top: 1px solid #edf1ef;
            border-bottom: 3px solid #087653;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        .nav-inner {
            display: flex;
            align-items: stretch;
            justify-content: center;
            flex-wrap: wrap;
        }

        .nav-item {
            color: #273936;
            font-size: 14px;
            font-weight: 800;
            padding: 14px 16px;
            border-right: 1px solid #edf1ef;
            transition: .2s;
        }

        .nav-item:first-child {
            border-left: 1px solid #edf1ef;
        }

        .nav-item:hover,
        .nav-item.active {
            background: #087653;
            color: #fff;
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            padding-top: 18px;
        }

        .hero-box {
            position: relative;
            overflow: hidden;
            min-height: 430px;
            background: #123c32;
            border-radius: 6px;
            box-shadow: 0 8px 25px rgba(0,0,0,.08);
        }

        .hero-slide {
            display: none;
            position: relative;
            min-height: 430px;
        }

        .hero-slide.active {
            display: block;
        }

        .hero-image {
            width: 100%;
            height: 430px;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(
                    90deg,
                    rgba(3,34,26,.82),
                    rgba(3,34,26,.48) 48%,
                    rgba(3,34,26,.08)
                );
            display: flex;
            align-items: center;
        }

        .hero-content {
            width: min(720px, 90%);
            padding: 45px;
            color: #fff;
        }

        .hero-label {
            display: inline-block;
            margin-bottom: 13px;
            padding: 6px 11px;
            border-left: 3px solid #fff;
            background: rgba(255,255,255,.12);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .hero-content h1 {
            margin: 0 0 13px;
            font-size: clamp(29px, 5vw, 48px);
            line-height: 1.15;
            font-weight: 900;
        }

        .hero-content p {
            margin: 0;
            max-width: 650px;
            font-size: 16px;
            line-height: 1.8;
            color: rgba(255,255,255,.93);
        }

        .hero-dots {
            position: absolute;
            left: 45px;
            bottom: 22px;
            display: flex;
            gap: 8px;
        }

        .hero-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: rgba(255,255,255,.55);
            cursor: pointer;
        }

        .hero-dot.active {
            background: #fff;
            transform: scale(1.3);
        }

        .hero-empty {
            min-height: 430px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            padding: 30px;
        }

        .hero-empty h1 {
            font-size: 38px;
            margin-bottom: 10px;
        }

        /* =========================
           NOTICE TICKER
        ========================= */

        .notice-ticker {
            margin-top: 16px;
            background: #fff;
            border: 1px solid #dfe7e4;
            display: flex;
            align-items: stretch;
            min-height: 48px;
            overflow: hidden;
        }

        .ticker-title {
            background: #087653;
            color: #fff;
            min-width: 125px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 900;
        }

        .ticker-content {
            padding: 13px 18px;
            flex: 1;
            color: #43534f;
            font-size: 13px;
            font-weight: 700;
        }

        /* =========================
           QUICK SERVICES
        ========================= */

        .quick-section {
            margin-top: 18px;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .quick-card {
            background: #fff;
            border: 1px solid #e0e7e4;
            padding: 19px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #153f34;
            font-weight: 900;
            transition: .2s;
        }

        .quick-card:hover {
            border-color: #087653;
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(8,118,83,.10);
        }

        .quick-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8f4ef;
            border-radius: 5px;
            font-size: 21px;
            flex-shrink: 0;
        }

        /* =========================
           SECTION
        ========================= */

        .section {
            padding-top: 48px;
            scroll-margin-top: 20px;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
        }

        .section-title-wrap {
            border-left: 4px solid #087653;
            padding-left: 12px;
        }

        .section-title {
            margin: 0;
            color: #143d33;
            font-size: 24px;
            font-weight: 900;
        }

        .section-subtitle {
            margin: 5px 0 0;
            color: #87938f;
            font-size: 12px;
        }

        .view-all {
            color: #087653;
            font-size: 13px;
            font-weight: 800;
        }

        .view-all:hover {
            text-decoration: underline;
        }

        /* =========================
           ABOUT
        ========================= */

        .about-grid {
            display: grid;
            grid-template-columns: 1.5fr .8fr;
            gap: 20px;
        }

        .about-card,
        .principal-card {
            background: #fff;
            border: 1px solid #e0e7e4;
            padding: 27px;
        }

        .about-card p {
            margin: 0;
            color: #586965;
            line-height: 1.9;
            font-size: 14px;
        }

        .principal-card {
            text-align: center;
            border-top: 4px solid #087653;
        }

        .principal-photo,
        .principal-placeholder {
            width: 115px;
            height: 115px;
            margin-bottom: 12px;
            border-radius: 50%;
        }

        .principal-photo {
            object-fit: cover;
            border: 4px solid #e8f4ef;
        }

        .principal-placeholder {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #e8f4ef;
            color: #087653;
            font-size: 40px;
        }

        .principal-name {
            margin: 0;
            color: #153f34;
            font-size: 18px;
            font-weight: 900;
        }

        .principal-message {
            margin-top: 6px;
            color: #087653;
            font-size: 12px;
            font-weight: 800;
        }

        /* =========================
           NOTICES
        ========================= */

        .notice-layout {
            display: grid;
            grid-template-columns: 1.55fr .8fr;
            gap: 20px;
        }

        .notice-list,
        .page-list {
            background: #fff;
            border: 1px solid #e0e7e4;
        }

        .notice-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 15px 18px;
            border-bottom: 1px solid #edf1ef;
        }

        .notice-item:last-child {
            border-bottom: none;
        }

        .notice-date {
            width: 56px;
            flex-shrink: 0;
            text-align: center;
            background: #e8f4ef;
            color: #087653;
            padding: 7px 4px;
            font-size: 11px;
            font-weight: 900;
        }

        .notice-title {
            color: #283a36;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.5;
        }

        .notice-title:hover {
            color: #087653;
        }

        .notice-type {
            margin-top: 4px;
            color: #9aa5a2;
            font-size: 10px;
            font-weight: 700;
        }

        /* =========================
           NEWS
        ========================= */

        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .news-card {
            background: #fff;
            border: 1px solid #e0e7e4;
            overflow: hidden;
            transition: .2s;
        }

        .news-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,.07);
        }

        .news-image {
            width: 100%;
            height: 185px;
            object-fit: cover;
            background: #e8f4ef;
        }

        .news-body {
            padding: 17px;
        }

        .news-date {
            color: #087653;
            font-size: 11px;
            font-weight: 800;
        }

        .news-title {
            margin: 7px 0;
            color: #1d302c;
            font-size: 17px;
            line-height: 1.45;
            font-weight: 900;
        }

        .news-description {
            color: #6b7975;
            font-size: 13px;
            line-height: 1.7;
        }

        /* =========================
           TEACHERS
        ========================= */

        .teacher-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .teacher-card {
            background: #fff;
            border: 1px solid #e0e7e4;
            padding: 20px 13px;
            text-align: center;
        }

        .teacher-photo,
        .teacher-placeholder {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            margin-bottom: 11px;
        }

        .teacher-photo {
            object-fit: cover;
            border: 3px solid #e8f4ef;
        }

        .teacher-placeholder {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #e8f4ef;
            color: #087653;
            font-size: 31px;
        }

        .teacher-name {
            margin: 0;
            color: #153f34;
            font-size: 15px;
            font-weight: 900;
        }

        .teacher-designation {
            margin-top: 5px;
            color: #087653;
            font-size: 12px;
            font-weight: 800;
        }

        .teacher-subject {
            margin-top: 4px;
            color: #929d9a;
            font-size: 11px;
        }

        /* =========================
           GALLERY
        ========================= */

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .gallery-item {
            position: relative;
            height: 205px;
            overflow: hidden;
            background: #e8f4ef;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .35s;
        }

        .gallery-item:hover img {
            transform: scale(1.07);
        }

        .gallery-caption {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 28px 11px 11px;
            color: #fff;
            background: linear-gradient(transparent, rgba(0,0,0,.78));
            font-size: 12px;
            font-weight: 800;
        }

        /* =========================
           PAGES
        ========================= */

        .page-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .page-link {
            padding: 15px 18px;
            color: #30413d;
            border-bottom: 1px solid #edf1ef;
            transition: .2s;
            font-size: 13px;
            font-weight: 700;
        }

        .page-link:hover {
            background: #f4f8f6;
            color: #087653;
        }

        /* =========================
           CONTACT
        ========================= */

        .contact-box {
            background: #123c32;
            color: #fff;
            padding: 32px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .contact-item h3 {
            margin: 0 0 7px;
            font-size: 14px;
            font-weight: 900;
        }

        .contact-item p {
            margin: 0;
            color: rgba(255,255,255,.82);
            line-height: 1.7;
            font-size: 13px;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            margin-top: 50px;
            background: #062b22;
            color: #fff;
        }

        .footer-inner {
            min-height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-text {
            color: rgba(255,255,255,.70);
            font-size: 12px;
        }

        .footer-social {
            display: flex;
            gap: 15px;
        }

        .footer-social a {
            color: #fff;
            font-size: 12px;
            font-weight: 700;
        }

        .empty-message {
            background: #fff;
            border: 1px solid #e0e7e4;
            padding: 32px;
            text-align: center;
            color: #8b9793;
            font-size: 13px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 950px) {

            .header-inner {
                grid-template-columns: 1fr;
                padding: 18px 0;
                gap: 13px;
            }

            .admin-area,
            .language-area {
                justify-content: center;
            }

            .school-brand {
                justify-content: center;
            }

            .quick-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .about-grid,
            .notice-layout {
                grid-template-columns: 1fr;
            }

            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .teacher-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {

            .container {
                width: calc(100% - 20px);
            }

            .top-bar-inner {
                padding: 8px 0;
                flex-direction: column;
                align-items: center;
                gap: 7px;
            }

            .top-contact {
                justify-content: center;
                gap: 10px;
            }

            .school-logo,
            .school-logo-placeholder {
                width: 62px;
                height: 62px;
            }

            .school-name {
                font-size: 21px;
                text-align: center;
            }

            .school-address {
                text-align: center;
            }

            .nav-inner {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .nav-item {
                text-align: center;
                padding: 11px 6px;
                font-size: 12px;
            }

            .hero-box,
            .hero-slide,
            .hero-empty {
                min-height: 330px;
            }

            .hero-image {
                height: 330px;
            }

            .hero-content {
                padding: 25px;
            }

            .hero-content h1 {
                font-size: 29px;
            }

            .hero-content p {
                font-size: 13px;
            }

            .hero-dots {
                left: 25px;
            }

            .ticker-title {
                min-width: 85px;
                font-size: 11px;
            }

            .ticker-content {
                padding: 12px 10px;
                font-size: 11px;
            }

            .quick-grid,
            .news-grid,
            .teacher-grid,
            .gallery-grid,
            .page-list {
                grid-template-columns: 1fr;
            }

            .section {
                padding-top: 38px;
            }

            .section-title {
                font-size: 21px;
            }

            .footer-inner {
                padding: 20px 0;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>

<body>



{{-- =========================================================
     HEADER
========================================================= --}}

<header class="main-header">

    <div class="container header-inner">

        {{-- ADMIN LOGIN LEFT --}}

        <div class="admin-area">

            <a href="{{ url('/login') }}" class="admin-button">
                
                {{ app()->getLocale() === 'en' ? 'Admin Login' : 'অ্যাডমিন লগইন' }}
            </a>

        </div>


        {{-- SCHOOL BRAND --}}

        <a href="{{ url('/') }}" class="school-brand">

            @if($settings?->logo)

                <img
                    src="{{ asset($settings->logo) }}"
                    alt="{{ $settings?->school_name }}"
                    class="school-logo"
                >

            @else

                <div class="school-logo-placeholder">
                    {{ mb_substr($settings?->school_name ?? (app()->getLocale() === 'en' ? 'School' : 'বিদ্যালয়'), 0, 1) }}
                </div>

            @endif

            <div>

                <h1 class="school-name">
                    {{ $settings?->school_name ?? (app()->getLocale() === 'en' ? 'Our School' : 'আমাদের বিদ্যালয়') }}
                </h1>

                @if($settings?->address)

                    <p class="school-address">
                        {{ $settings->address }}
                    </p>

                @endif

            </div>

        </a>


        {{-- LANGUAGE SWITCH --}}

        <div class="language-area">

            <div class="language-switch">

                <a
                    href="{{ route('language.switch', 'bn') }}"
                    class="{{ app()->getLocale() === 'bn' ? 'active' : '' }}"
                >
                    বাংলা
                </a>

                <a
                    href="{{ route('language.switch', 'en') }}"
                    class="{{ app()->getLocale() === 'en' ? 'active' : '' }}"
                >
                    English
                </a>

            </div>

        </div>

    </div>

</header>


{{-- =========================================================
     NAVIGATION
========================================================= --}}

<nav class="main-nav">

    <div class="container nav-inner">

        <a href="{{ url('/') }}" class="nav-item active">
            {{ __('home') }}
        </a>

        <a href="#about" class="nav-item">
            {{ __('about') }}
        </a>

        <a href="#administration" class="nav-item">
            {{ __('administration') }}
        </a>

        <a href="#teachers" class="nav-item">
            {{ __('teachers') }}
        </a>

        <a href="#students" class="nav-item">
            {{ __('students') }}
        </a>

        <a href="#notices" class="nav-item">
            {{ __('notices') }}
        </a>

        <a href="#news" class="nav-item">
            {{ __('news') }}
        </a>

        <a href="#gallery" class="nav-item">
            {{ __('gallery') }}
        </a>

        <a href="#contact" class="nav-item">
            {{ __('contact') }}
        </a>


        {{-- DYNAMIC CUSTOM LINKS --}}

        @foreach($customLinks as $link)

            <a
                href="{{ $link->url }}"
                class="nav-item"

                @if($link->open_in_new_tab)
                    target="_blank"
                    rel="noopener"
                @endif
            >

                @if($link->icon)
                    {{ $link->icon }}
                @endif

                {{ $link->name }}

            </a>

        @endforeach

    </div>

</nav>


{{-- =========================================================
     HERO
========================================================= --}}

<main>

    <section class="hero">

        <div class="container">

            <div class="hero-box">

                @forelse($banners as $index => $banner)

                    <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">

                        @if($banner->image)

                            <img
                                src="{{ asset($banner->image) }}"
                                alt="{{ $banner->title }}"
                                class="hero-image"
                            >

                        @endif

                        <div class="hero-overlay">

                            <div class="hero-content">

                                <div class="hero-label">
                                    {{ app()->getLocale() === 'en'
                                        ? 'OFFICIAL SCHOOL WEBSITE'
                                        : 'বিদ্যালয়ের অফিসিয়াল ওয়েবসাইট' }}
                                </div>

                                @if($banner->title)

                                    <h1>
                                        {{ $banner->title }}
                                    </h1>

                                @endif

                                @if($banner->subtitle)

                                    <p>
                                        {{ $banner->subtitle }}
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="hero-empty">

                        <div>

                            <h1>
                                {{ $settings?->school_name ?? (app()->getLocale() === 'en' ? 'Our School' : 'আমাদের বিদ্যালয়') }}
                            </h1>

                            <p>
                                {{ app()->getLocale() === 'en'
                                    ? 'Welcome to the official website of our institution.'
                                    : 'স্বাগতম আমাদের বিদ্যালয়ের অফিসিয়াল ওয়েবসাইটে।' }}
                            </p>

                        </div>

                    </div>

                @endforelse


                @if($banners->count() > 1)

                    <div class="hero-dots">

                        @foreach($banners as $index => $banner)

                            <span
                                class="hero-dot {{ $index === 0 ? 'active' : '' }}"
                                onclick="showSlide({{ $index }})"
                            ></span>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>

    </section>


    {{-- =====================================================
         NOTICE TICKER
    ====================================================== --}}

    <div class="container">

        <div class="notice-ticker">

            <div class="ticker-title">
                📢 {{ __('notices') }}
            </div>

            <div class="ticker-content">

                @if($notices->count())

                    {{ $notices->first()->title }}

                @else

                    {{ app()->getLocale() === 'en'
                        ? 'No notice has been published yet.'
                        : 'বর্তমানে কোনো নোটিশ প্রকাশিত হয়নি।' }}

                @endif

            </div>

        </div>

    </div>


    {{-- =====================================================
         QUICK SERVICES
    ====================================================== --}}

    <section class="quick-section">

        <div class="container">

            <div class="quick-grid">

                <a href="#notices" class="quick-card">
                    <div class="quick-icon">📢</div>
                    <span>{{ __('latest_notices') }}</span>
                </a>

                <a href="#teachers" class="quick-card">
                    <div class="quick-icon">👨‍🏫</div>
                    <span>{{ __('teachers_staff') }}</span>
                </a>

                <a href="#news" class="quick-card">
                    <div class="quick-icon">📰</div>
                    <span>{{ __('latest_news') }}</span>
                </a>

                <a href="#gallery" class="quick-card">
                    <div class="quick-icon">🖼️</div>
                    <span>{{ __('gallery_title') }}</span>
                </a>

            </div>

        </div>

    </section>


    {{-- =====================================================
         ABOUT
    ====================================================== --}}

    <section class="section" id="about">

        <div class="container">

            <div class="section-header">

                <div class="section-title-wrap">

                    <h2 class="section-title">
                        {{ __('about_school') }}
                    </h2>

                    <p class="section-subtitle">
                        {{ app()->getLocale() === 'en'
                            ? 'Information about our institution'
                            : 'আমাদের প্রতিষ্ঠান সম্পর্কে তথ্য' }}
                    </p>

                </div>

            </div>


            <div class="about-grid">

                <div class="about-card">

                    <p>
                        {{ $settings?->principal_message
                            ?? (app()->getLocale() === 'en'
                                ? 'Our institution is committed to quality education, moral values and the development of students through modern knowledge and skills.'
                                : 'আমাদের বিদ্যালয় শিক্ষার্থীদের মানসম্মত শিক্ষা, নৈতিক মূল্যবোধ ও আধুনিক জ্ঞান অর্জনের জন্য কাজ করে যাচ্ছে।') }}
                    </p>

                </div>


                <div class="principal-card">

                    @if($settings?->principal_photo)

                        <img
                            src="{{ asset($settings->principal_photo) }}"
                            alt="{{ $settings->principal_name }}"
                            class="principal-photo"
                        >

                    @else

                        <div class="principal-placeholder">
                            👤
                        </div>

                    @endif

                    <h3 class="principal-name">
                        {{ $settings?->principal_name ?? (app()->getLocale() === 'en' ? 'Principal' : 'প্রধান শিক্ষক') }}
                    </h3>

                    <div class="principal-message">
                        {{ app()->getLocale() === 'en'
                            ? 'Principal'
                            : 'প্রধান শিক্ষক' }}
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         ADMINISTRATION
    ====================================================== --}}

    <section class="section" id="administration">

        <div class="container">

            <div class="section-header">

                <div class="section-title-wrap">

                    <h2 class="section-title">
                        {{ __('administration') }}
                    </h2>

                    <p class="section-subtitle">
                        {{ app()->getLocale() === 'en'
                            ? 'Institutional administration'
                            : 'প্রতিষ্ঠানের প্রশাসনিক কার্যক্রম' }}
                    </p>

                </div>

            </div>


            <div class="about-card">

                <h3 style="margin-top:0;color:#123c32;">

                    {{ app()->getLocale() === 'en'
                        ? 'School Administration'
                        : 'বিদ্যালয় প্রশাসন' }}

                </h3>

                <p>

                    {{ app()->getLocale() === 'en'
                        ? 'The school administration works to ensure smooth academic and administrative activities of the institution.'
                        : 'বিদ্যালয়ের সকল একাডেমিক ও প্রশাসনিক কার্যক্রম সুষ্ঠুভাবে পরিচালনার জন্য বিদ্যালয় প্রশাসন কাজ করে যাচ্ছে।' }}

                </p>

                @if($settings?->principal_name)

                    <p style="margin-top:15px;">

                        <strong>
                            {{ app()->getLocale() === 'en'
                                ? 'Principal:'
                                : 'প্রধান শিক্ষক:' }}
                        </strong>

                        {{ $settings->principal_name }}

                    </p>

                @endif

            </div>

        </div>

    </section>


    {{-- =====================================================
         STUDENTS
    ====================================================== --}}

    <section class="section" id="students">

        <div class="container">

            <div class="section-header">

                <div class="section-title-wrap">

                    <h2 class="section-title">
                        {{ __('students') }}
                    </h2>

                    <p class="section-subtitle">
                        {{ app()->getLocale() === 'en'
                            ? 'Student activities and information'
                            : 'শিক্ষার্থীদের কার্যক্রম ও তথ্য' }}
                    </p>

                </div>

            </div>


            <div class="about-card">

                <p>

                    {{ app()->getLocale() === 'en'
                        ? 'Our students regularly participate in academic classes, co-curricular activities, cultural programs and various educational activities.'
                        : 'আমাদের বিদ্যালয়ের শিক্ষার্থীরা নিয়মিত পাঠদান, সহশিক্ষা কার্যক্রম, সাংস্কৃতিক অনুষ্ঠান ও বিভিন্ন শিক্ষামূলক কার্যক্রমে অংশগ্রহণ করে।' }}

                </p>

            </div>

        </div>

    </section>


    {{-- =====================================================
         NOTICES
    ====================================================== --}}

    <section class="section" id="notices">

        <div class="container">

            <div class="section-header">

                <div class="section-title-wrap">

                    <h2 class="section-title">
                        {{ __('latest_notices') }}
                    </h2>

                </div>

            </div>


            @if($notices->count())

                <div class="notice-list">

                    @foreach($notices as $notice)

                        @php

                            $noticeUrl = '#';

                            if ($notice->type === 'link' && $notice->external_url) {
                                $noticeUrl = $notice->external_url;
                            } elseif ($notice->file_path) {
                                $noticeUrl = asset($notice->file_path);
                            }

                        @endphp


                        <div class="notice-item">

                            <div class="notice-date">

                                {{ optional($notice->publish_date)->format('d') }}

                                <br>

                                {{ optional($notice->publish_date)->format('M') }}

                            </div>


                            <div style="flex:1;">

                                <a
                                    href="{{ $noticeUrl }}"
                                    class="notice-title"

                                    @if($noticeUrl !== '#')
                                        target="_blank"
                                        rel="noopener"
                                    @endif
                                >

                                    {{ $notice->title }}

                                </a>


                                <div class="notice-type">

                                    {{ strtoupper($notice->type) }}

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-message">

                    {{ app()->getLocale() === 'en'
                        ? 'No notice has been published yet.'
                        : 'বর্তমানে কোনো নোটিশ প্রকাশিত হয়নি।' }}

                </div>

            @endif

        </div>

    </section>


    {{-- =====================================================
         NEWS
    ====================================================== --}}

    <section class="section" id="news">

        <div class="container">

            <div class="section-header">

                <div class="section-title-wrap">

                    <h2 class="section-title">
                        {{ __('latest_news') }}
                    </h2>

                </div>

            </div>


            @if($news->count())

                <div class="news-grid">

                    @foreach($news as $item)

                        <article class="news-card">

                            @if($item->image)

                                <img
                                    src="{{ asset($item->image) }}"
                                    alt="{{ $item->title }}"
                                    class="news-image"
                                >

                            @else

                                <div class="news-image"></div>

                            @endif


                            <div class="news-body">

                                @if($item->publish_date)

                                    <div class="news-date">

                                        {{ $item->publish_date->format('d M, Y') }}

                                    </div>

                                @endif


                                <h3 class="news-title">

                                    {{ $item->title }}

                                </h3>


                                @if($item->description)

                                    <div class="news-description">

                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 150) }}

                                    </div>

                                @endif

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-message">

                    {{ app()->getLocale() === 'en'
                        ? 'No news has been published yet.'
                        : 'বর্তমানে কোনো খবর প্রকাশিত হয়নি।' }}

                </div>

            @endif

        </div>

    </section>


    {{-- =====================================================
         TEACHERS
    ====================================================== --}}

    <section class="section" id="teachers">

        <div class="container">

            <div class="section-header">

                <div class="section-title-wrap">

                    <h2 class="section-title">
                        {{ __('teachers_staff') }}
                    </h2>

                </div>

            </div>


            @if($teachers->count())

                <div class="teacher-grid">

                    @foreach($teachers as $teacher)

                        <div class="teacher-card">

                            @if($teacher->photo)

                                <img
                                    src="{{ asset($teacher->photo) }}"
                                    alt="{{ $teacher->name }}"
                                    class="teacher-photo"
                                >

                            @else

                                <div class="teacher-placeholder">
                                    👤
                                </div>

                            @endif


                            <h3 class="teacher-name">
                                {{ $teacher->name }}
                            </h3>


                            @if($teacher->designation)

                                <div class="teacher-designation">
                                    {{ $teacher->designation }}
                                </div>

                            @endif


                            @if($teacher->subject)

                                <div class="teacher-subject">
                                    {{ $teacher->subject }}
                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-message">

                    {{ app()->getLocale() === 'en'
                        ? 'No teacher information has been added yet.'
                        : 'বর্তমানে কোনো শিক্ষক তথ্য যোগ করা হয়নি।' }}

                </div>

            @endif

        </div>

    </section>


    {{-- =====================================================
         GALLERY
    ====================================================== --}}

    <section class="section" id="gallery">

        <div class="container">

            <div class="section-header">

                <div class="section-title-wrap">

                    <h2 class="section-title">
                        {{ __('gallery_title') }}
                    </h2>

                </div>

            </div>


            @if($galleries->count())

                <div class="gallery-grid">

                    @foreach($galleries as $gallery)

                        <div class="gallery-item">

                            <img
                                src="{{ asset($gallery->image) }}"
                                alt="{{ $gallery->title }}"
                            >

                            @if($gallery->title)

                                <div class="gallery-caption">

                                    {{ $gallery->title }}

                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-message">

                    {{ app()->getLocale() === 'en'
                        ? 'No gallery images have been added yet.'
                        : 'বর্তমানে কোনো ছবি গ্যালারিতে যোগ করা হয়নি।' }}

                </div>

            @endif

        </div>

    </section>


    {{-- =====================================================
         PUBLIC PAGES
    ====================================================== --}}

    @if($pages->count())

        <section class="section">

            <div class="container">

                <div class="section-header">

                    <div class="section-title-wrap">

                        <h2 class="section-title">

                            {{ app()->getLocale() === 'en'
                                ? 'Important Information'
                                : 'গুরুত্বপূর্ণ তথ্য' }}

                        </h2>

                    </div>

                </div>


                <div class="page-list">

                    @foreach($pages as $page)

                        <a
                            href="{{ route('public.page', $page->slug) }}"
                            class="page-link"
                        >

                            {{ $page->title }}

                        </a>

                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         CONTACT
    ====================================================== --}}

    <section class="section" id="contact">

        <div class="container">

            <div class="section-header">

                <div class="section-title-wrap">

                    <h2 class="section-title">
                        {{ __('contact_us') }}
                    </h2>

                </div>

            </div>


            <div class="contact-box">

                <div class="contact-grid">

                    <div class="contact-item">

                        <h3>
                            {{ app()->getLocale() === 'en'
                                ? 'Address'
                                : 'ঠিকানা' }}
                        </h3>

                        <p>
                            {{ $settings?->address
                                ?? (app()->getLocale() === 'en'
                                    ? 'School address will appear here.'
                                    : 'বিদ্যালয়ের ঠিকানা এখানে প্রদর্শিত হবে।') }}
                        </p>

                    </div>


                    <div class="contact-item">

                        <h3>
                            {{ app()->getLocale() === 'en'
                                ? 'Phone'
                                : 'ফোন' }}
                        </h3>

                        <p>
                            {{ $settings?->phone
                                ?? (app()->getLocale() === 'en'
                                    ? 'Phone number will appear here.'
                                    : 'ফোন নম্বর এখানে প্রদর্শিত হবে।') }}
                        </p>

                    </div>


                    <div class="contact-item">

                        <h3>
                            {{ app()->getLocale() === 'en'
                                ? 'Email'
                                : 'ই-মেইল' }}
                        </h3>

                        <p>
                            {{ $settings?->email
                                ?? (app()->getLocale() === 'en'
                                    ? 'Email address will appear here.'
                                    : 'ই-মেইল এখানে প্রদর্শিত হবে।') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

</main>


{{-- =========================================================
     FOOTER
========================================================= --}}

<footer>

    <div class="container footer-inner">

        <div class="footer-text">

            © {{ date('Y') }}

            {{ $settings?->school_name ?? (app()->getLocale() === 'en' ? 'Our School' : 'আমাদের বিদ্যালয়') }}

            —

            {{ app()->getLocale() === 'en'
                ? 'All rights reserved.'
                : 'সর্বস্বত্ব সংরক্ষিত।' }}

        </div>


        <div class="footer-social">

            @if($settings?->facebook_url)

                <a
                    href="{{ $settings->facebook_url }}"
                    target="_blank"
                    rel="noopener"
                >
                    Facebook
                </a>

            @endif


            @if($settings?->youtube_url)

                <a
                    href="{{ $settings->youtube_url }}"
                    target="_blank"
                    rel="noopener"
                >
                    YouTube
                </a>

            @endif

        </div>

    </div>

</footer>


{{-- =========================================================
     HERO SLIDER SCRIPT
========================================================= --}}

<script>

    let currentSlide = 0;

    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');


    function showSlide(index) {

        if (!slides.length) {
            return;
        }

        slides.forEach((slide) => {
            slide.classList.remove('active');
        });

        dots.forEach((dot) => {
            dot.classList.remove('active');
        });

        currentSlide = index;

        slides[currentSlide].classList.add('active');

        if (dots[currentSlide]) {
            dots[currentSlide].classList.add('active');
        }

    }


    function nextSlide() {

        if (!slides.length) {
            return;
        }

        currentSlide =
            (currentSlide + 1) % slides.length;

        showSlide(currentSlide);

    }


    if (slides.length > 1) {

        setInterval(nextSlide, 5000);

    }

</script>

</body>
</html>
