<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | School Website</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .nav-scroll {
            scrollbar-width: none;
        }

        .nav-scroll::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

    <!-- =====================================================
         HEADER
    ====================================================== -->
    <header class="border-b border-slate-200 bg-white">

        <!-- Main Header -->
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">

            <!-- School Logo + Name -->
            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-lg font-bold text-white shadow-sm">
                    S
                </div>

                <div>
                    <h1 class="text-base font-bold text-slate-900 sm:text-lg">
                        School Website
                    </h1>

                    <p class="text-xs text-slate-500">
                        Administration Panel
                    </p>
                </div>

            </div>


            <!-- Admin Profile + Logout -->
            <div class="flex items-center gap-3">

                <!-- Admin Name -->
                <div class="hidden text-right sm:block">

                    <p class="text-sm font-semibold text-slate-800">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </p>

                    <p class="text-xs text-slate-500">
                        Administrator
                    </p>

                </div>


                <!-- Avatar -->
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700">

                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}

                </div>


                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="rounded-xl border border-red-200 bg-white px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                    >
                        Logout
                    </button>

                </form>

            </div>

        </div>


        <!-- =================================================
             NAVIGATION
        ================================================== -->
        <div class="border-t border-slate-100 bg-white">

            <nav class="nav-scroll mx-auto flex max-w-7xl gap-1 overflow-x-auto px-5 py-2 lg:px-8">

                <!-- Dashboard -->
                <a
                    href="{{ route('dashboard') }}"
                    class="whitespace-nowrap rounded-lg bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700"
                >
                    Dashboard
                </a>


                @foreach([
                    ['school-info', 'School Info', 'admin.school-info.edit'],
                    ['banners', 'Banners', 'admin.banners.index'],
                    ['notices', 'Notices', 'admin.notices.index'],
                    ['custom-links', 'Custom Links', 'admin.custom-links.index'],
                    ['teachers', 'Teachers', 'admin.teachers.index'],
                    ['gallery', 'Gallery', 'admin.gallery.index'],
                    ['news', 'News & Events', 'admin.news.index'],
                    ['pages', 'Pages', 'admin.pages.index'],
                    ['settings', 'Settings', 'profile.edit'],
                    ['users', 'User Access', 'admin.users.index'],
                ] as [$permission, $label, $route])
                    @if(auth()->user()->hasAdminPermission($permission))
                        <a
                            href="{{ route($route) }}"
                            class="whitespace-nowrap rounded-lg px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                        >
                            {{ $label }}
                        </a>
                    @endif
                @endforeach

            </nav>

        </div>

    </header>


    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->
    <main class="mx-auto max-w-7xl px-5 py-8 lg:px-8">


        <!-- =================================================
             WELCOME SECTION
        ================================================== -->
        <section class="mb-8">

            <p class="mb-2 text-sm font-semibold tracking-wide text-blue-600">
                ADMIN DASHBOARD
            </p>

            <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                Welcome back, {{ auth()->user()->name ?? 'Administrator' }}
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Manage your school's website, information and online content
                from one simple dashboard.
            </p>

        </section>


        <!-- =================================================
             WEBSITE MANAGEMENT
        ================================================== -->
        <section>

            <div class="mb-5">

                <h3 class="text-xl font-bold text-slate-900">
                    Website Management
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Choose an area to manage your school website.
                </p>

            </div>


            <!-- Management Cards -->
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">


                <!-- =================================================
                     SCHOOL INFORMATION
                ================================================== -->
                @if(auth()->user()->hasAdminPermission('school-info'))
                <a
                    href="{{ route('admin.school-info.edit') }}"
                    id="school-info"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-md"
                >

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 9h.01M15 9h.01M9 13h.01M15 13h.01"
                            />
                        </svg>

                    </div>

                    <h4 class="text-lg font-bold text-slate-900">
                        School Information
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Manage school name, logo, address, contact information
                        and principal details.
                    </p>

                    <div class="mt-5 text-sm font-semibold text-blue-600">
                        Manage →
                    </div>

                </a>
                @endif


                <!-- =================================================
                     BANNERS
                ================================================== -->
                @if(auth()->user()->hasAdminPermission('banners'))
                <a
                    href="{{ route('admin.banners.index') }}"
                    id="banners"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-md"
                >

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M4 6h16M4 10h16M4 14h10M4 18h7"
                            />
                        </svg>

                    </div>

                    <h4 class="text-lg font-bold text-slate-900">
                        Banners
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Add and manage the main banners displayed on the
                        school website.
                    </p>

                    <div class="mt-5 text-sm font-semibold text-indigo-600">
                        Manage →
                    </div>

                </a>
                @endif


                <!-- =================================================
                     NOTICES
                ================================================== -->
                @if(auth()->user()->hasAdminPermission('notices'))
                <a
                    href="{{ route('admin.notices.index') }}"
                    id="notices"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-amber-200 hover:shadow-md"
                >

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M15 17h5l-1.5-1.5V11a6.5 6.5 0 00-13 0v4.5L4 17h5m6 0a3 3 0 01-6 0"
                            />
                        </svg>

                    </div>

                    <h4 class="text-lg font-bold text-slate-900">
                        Notices
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Publish school notices, announcements, PDF files
                        and important links.
                    </p>

                    <div class="mt-5 text-sm font-semibold text-amber-600">
                        Manage →
                    </div>

                </a>
                @endif

                
                <!-- =================================================
                    CUSTOM LINKS
                ================================================== -->
                @if(auth()->user()->hasAdminPermission('custom-links'))
                <a
                    href="{{ route('admin.custom-links.index') }}"
                    id="custom-links"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-md"
                >

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M10 13a5 5 0 007.07 0l2-2a5 5 0 00-7.07-7.07l-1.15 1.15M14 11a5 5 0 00-7.07 0l-2 2A5 5 0 0012 20.07l1.15-1.15"
                            />
                        </svg>

                    </div>

                    <h4 class="text-lg font-bold text-slate-900">
                        Custom Links
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Add and manage important external links for the school website.
                    </p>

                    <div class="mt-5 text-sm font-semibold text-emerald-600">
                        Manage →
                    </div>

                </a>
                @endif



                <!-- =================================================
                     TEACHERS
                ================================================== -->
                @if(auth()->user()->hasAdminPermission('teachers'))
                <a
                    href="{{ route('admin.teachers.index') }}"
                    id="teachers"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-md"
                >

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zm7-4a3 3 0 110 6m4 8v-2a4 4 0 00-3-3.87"
                            />
                        </svg>

                    </div>

                    <h4 class="text-lg font-bold text-slate-900">
                        Teachers
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Manage teacher profiles, designation, subjects,
                        photos and contact information.
                    </p>

                    <div class="mt-5 text-sm font-semibold text-emerald-600">
                        Manage →
                    </div>

                </a>
                @endif


                <!-- =================================================
                     GALLERY
                ================================================== -->
                @if(auth()->user()->hasAdminPermission('gallery'))
                <a
                    href="{{ route('admin.gallery.index') }}"
                    id="gallery"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-pink-200 hover:shadow-md"
                >

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-pink-50 text-pink-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M4 5h16v14H4zM8 10a2 2 0 100-4 2 2 0 000 4zm12 6-5-5-4 4-2-2-5 5"
                            />
                        </svg>

                    </div>

                    <h4 class="text-lg font-bold text-slate-900">
                        Gallery
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Upload and organize photos from school activities,
                        events and programs.
                    </p>

                    <div class="mt-5 text-sm font-semibold text-pink-600">
                        Manage →
                    </div>

                </a>
                @endif


                <!-- =================================================
                     NEWS & EVENTS
                ================================================== -->
                @if(auth()->user()->hasAdminPermission('news'))
                <a
                    href="{{ route('admin.news.index') }}"
                    id="news"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-violet-200 hover:shadow-md"
                >

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-violet-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M4 5h16v14H4zM7 9h10M7 13h6M7 17h4"
                            />
                        </svg>

                    </div>

                    <h4 class="text-lg font-bold text-slate-900">
                        News & Events
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Publish school news, upcoming events and important
                        activities.
                    </p>

                    <div class="mt-5 text-sm font-semibold text-violet-600">
                        Manage →
                    </div>

                </a>
                @endif


                <!-- =================================================
                     PAGES
                ================================================== -->
                @if(auth()->user()->hasAdminPermission('pages'))
                <a
                    href="{{ route('admin.pages.index') }}"
                    id="pages"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-cyan-200 hover:shadow-md"
                >

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M6 3h9l3 3v15H6zM14 3v4h4M9 12h6M9 16h6"
                            />
                        </svg>

                    </div>

                    <h4 class="text-lg font-bold text-slate-900">
                        Pages
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Create and edit pages such as About School,
                        History, Mission and Vision.
                    </p>

                    <div class="mt-5 text-sm font-semibold text-cyan-600">
                        Manage →
                    </div>

                </a>
                @endif


                <!-- =================================================
                     SETTINGS
                ================================================== -->
                @if(auth()->user()->hasAdminPermission('settings'))
                <a
                    href="{{ route('profile.edit') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-slate-300 hover:shadow-md"
                >

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M19.4 15a1.7 1.7 0 00.34 1.88l.06.06-1.5 1.5-.06-.06a1.7 1.7 0 00-1.88-.34 1.7 1.7 0 00-1.04 1.56V20h-2.12v-.4a1.7 1.7 0 00-1.04-1.56 1.7 1.7 0 00-1.88.34l-.06.06-1.5-1.5.06-.06A1.7 1.7 0 009.2 15a1.7 1.7 0 00-1.56-1.04H7.2v-2.12h.44A1.7 1.7 0 009.2 10.8a1.7 1.7 0 00-.34-1.88L8.8 8.86l1.5-1.5.06.06a1.7 1.7 0 001.88.34 1.7 1.7 0 001.04-1.56V5.8h2.12v.4a1.7 1.7 0 001.04 1.56 1.7 1.7 0 001.88-.34l.06-.06 1.5 1.5-.06.06A1.7 1.7 0 0019.4 10.8a1.7 1.7 0 001.56 1.04h.44v2.12h-.44A1.7 1.7 0 0019.4 15z"
                            />
                        </svg>

                    </div>

                    <h4 class="text-lg font-bold text-slate-900">
                        Settings
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Manage your administrator profile, password and
                        account settings.
                    </p>

                    <div class="mt-5 text-sm font-semibold text-slate-700">
                        Manage →
                    </div>

                </a>
                @endif

                @if(auth()->user()->hasAdminPermission('users'))
                    <a
                        href="{{ route('admin.users.index') }}"
                        class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-md"
                    >
                        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-10a4 4 0 110-8 4 4 0 010 8zm9 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900">User Access</h4>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Create accounts and control access to each admin section.</p>
                        <div class="mt-5 text-sm font-semibold text-indigo-600">Manage →</div>
                    </a>
                @endif

            </div>

        </section>


        <!-- =====================================================
             WEBSITE PREVIEW
        ====================================================== -->
        <section class="mt-10 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

                <div>

                    <p class="text-sm font-semibold text-blue-600">
                        YOUR WEBSITE
                    </p>

                    <h3 class="mt-1 text-lg font-bold text-slate-900">
                        Manage your school's online presence
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Visit the public website to see how your content
                        appears to visitors.
                    </p>

                </div>


                <a
                    href="/"
                    target="_blank"
                    class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700"
                >
                    View Website
                </a>

            </div>

        </section>

    </main>


    <!-- =====================================================
         FOOTER
    ====================================================== -->
    <footer class="border-t border-slate-200 bg-white">

        <div class="mx-auto max-w-7xl px-5 py-5 text-center text-xs text-slate-400 lg:px-8">

            © {{ date('Y') }} School Website Admin Panel.
            All rights reserved.

        </div>

    </footer>

</body>
</html>