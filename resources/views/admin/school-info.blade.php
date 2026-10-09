<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>School Information | Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

    <!-- Header -->
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-4">

            <div>
                <h1 class="text-xl font-bold text-slate-900">
                    School Information
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Manage your school's basic information.
                </p>
            </div>

            <a
                href="{{ route('dashboard') }}"
                class="rounded-xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200"
            >
                ← Dashboard
            </a>

        </div>
    </header>


    <!-- Main -->
    <main class="mx-auto max-w-6xl px-5 py-8">

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif


        <!-- Validation Errors -->
        @if($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

                <p class="mb-2 font-semibold">
                    Please fix the following errors:
                </p>

                <ul class="list-disc space-y-1 pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        <form
            method="POST"
            action="{{ route('admin.school-info.update') }}"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <!-- ==========================================
                 BASIC INFORMATION
            =========================================== -->
            <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-6 border-b border-slate-100 pb-5">

                    <h2 class="text-lg font-bold text-slate-900">
                        Basic Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Basic details of your school.
                    </p>

                </div>


                <div class="grid gap-6 md:grid-cols-2">

                    <!-- School Name -->
                    <div class="md:col-span-2">

                        <label class="text-sm font-semibold text-slate-700">
                            School Name
                        </label>

                        <input
                            type="text"
                            name="school_name"
                            value="{{ old('school_name', $settings->school_name ?? '') }}"
                            required
                            placeholder="Enter school name"
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >

                    </div>


                    <!-- Address -->
                    <div class="md:col-span-2">

                        <label class="text-sm font-semibold text-slate-700">
                            Address
                        </label>

                        <textarea
                            name="address"
                            rows="3"
                            placeholder="Enter school address"
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >{{ old('address', $settings->address ?? '') }}</textarea>

                    </div>


                    <!-- Phone -->
                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Phone Number
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', $settings->phone ?? '') }}"
                            placeholder="01XXXXXXXXX"
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >

                    </div>


                    <!-- Email -->
                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $settings->email ?? '') }}"
                            placeholder="school@example.com"
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >

                    </div>

                </div>

            </section>


            <!-- ==========================================
                 SCHOOL LOGO
            =========================================== -->
            <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-6 border-b border-slate-100 pb-5">

                    <h2 class="text-lg font-bold text-slate-900">
                        School Logo
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Upload the logo that will be used throughout the website.
                    </p>

                </div>


                <div class="flex flex-col gap-6 sm:flex-row sm:items-center">

                    <!-- Current Logo -->
                    <div class="flex h-28 w-28 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">

                        @if(!empty($settings?->logo))

                            <img
                                src="{{ asset($settings->logo) }}"
                                alt="School Logo"
                                class="h-full w-full object-contain"
                            >

                        @else

                            <span class="text-xs font-medium text-slate-400">
                                No Logo
                            </span>

                        @endif

                    </div>


                    <div class="flex-1">

                        <label class="text-sm font-semibold text-slate-700">
                            Upload New Logo
                        </label>

                        <input
                            type="file"
                            name="logo"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="mt-2 block w-full rounded-xl border border-slate-300 bg-white text-sm file:mr-4 file:border-0 file:bg-blue-50 file:px-4 file:py-3 file:font-semibold file:text-blue-700 hover:file:bg-blue-100"
                        >

                        <p class="mt-2 text-xs text-slate-400">
                            JPG, JPEG, PNG or WEBP. Maximum 2MB.
                        </p>

                    </div>

                </div>

            </section>


            <!-- ==========================================
                 PRINCIPAL INFORMATION
            =========================================== -->
            <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-6 border-b border-slate-100 pb-5">

                    <h2 class="text-lg font-bold text-slate-900">
                        Principal Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Add information about the school's principal.
                    </p>

                </div>


                <div class="grid gap-6 md:grid-cols-2">

                    <!-- Principal Name -->
                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Principal Name
                        </label>

                        <input
                            type="text"
                            name="principal_name"
                            value="{{ old('principal_name', $settings->principal_name ?? '') }}"
                            placeholder="Enter principal name"
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >

                    </div>


                    <!-- Principal Photo -->
                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Principal Photo
                        </label>

                        <input
                            type="file"
                            name="principal_photo"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="mt-2 block w-full rounded-xl border border-slate-300 bg-white text-sm file:mr-4 file:border-0 file:bg-blue-50 file:px-4 file:py-3 file:font-semibold file:text-blue-700 hover:file:bg-blue-100"
                        >

                        <p class="mt-2 text-xs text-slate-400">
                            JPG, JPEG, PNG or WEBP. Maximum 2MB.
                        </p>

                    </div>


                    <!-- Current Principal Photo -->
                    @if(!empty($settings?->principal_photo))

                        <div class="md:col-span-2">

                            <p class="mb-2 text-sm font-semibold text-slate-700">
                                Current Photo
                            </p>

                            <img
                                src="{{ asset($settings->principal_photo) }}"
                                alt="Principal"
                                class="h-32 w-32 rounded-2xl border border-slate-200 object-cover"
                            >

                        </div>

                    @endif


                    <!-- Principal Message -->
                    <div class="md:col-span-2">

                        <label class="text-sm font-semibold text-slate-700">
                            Principal's Message
                        </label>

                        <textarea
                            name="principal_message"
                            rows="6"
                            placeholder="Write a message from the principal..."
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >{{ old('principal_message', $settings->principal_message ?? '') }}</textarea>

                    </div>

                </div>

            </section>


            <!-- ==========================================
                 SOCIAL MEDIA
            =========================================== -->
            <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-6 border-b border-slate-100 pb-5">

                    <h2 class="text-lg font-bold text-slate-900">
                        Social Media
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Add your school's official social media links.
                    </p>

                </div>


                <div class="grid gap-6 md:grid-cols-2">

                    <!-- Facebook -->
                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Facebook URL
                        </label>

                        <input
                            type="url"
                            name="facebook_url"
                            value="{{ old('facebook_url', $settings->facebook_url ?? '') }}"
                            placeholder="https://facebook.com/..."
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >

                    </div>


                    <!-- YouTube -->
                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            YouTube URL
                        </label>

                        <input
                            type="url"
                            name="youtube_url"
                            value="{{ old('youtube_url', $settings->youtube_url ?? '') }}"
                            placeholder="https://youtube.com/..."
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >

                    </div>

                </div>

            </section>


            <!-- ==========================================
                 FAVICON
            =========================================== -->
            <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-6 border-b border-slate-100 pb-5">

                    <h2 class="text-lg font-bold text-slate-900">
                        Website Favicon
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Upload the small icon displayed in the browser tab.
                    </p>

                </div>


                <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                    @if(!empty($settings?->favicon))

                        <div class="flex h-16 w-16 items-center justify-center rounded-xl border border-slate-200 bg-slate-50">

                            <img
                                src="{{ asset($settings->favicon) }}"
                                alt="Favicon"
                                class="h-10 w-10 object-contain"
                            >

                        </div>

                    @endif


                    <div class="flex-1">

                        <input
                            type="file"
                            name="favicon"
                            accept=".jpg,.jpeg,.png,.webp,.ico"
                            class="block w-full rounded-xl border border-slate-300 bg-white text-sm file:mr-4 file:border-0 file:bg-blue-50 file:px-4 file:py-3 file:font-semibold file:text-blue-700 hover:file:bg-blue-100"
                        >

                        <p class="mt-2 text-xs text-slate-400">
                            JPG, PNG, WEBP or ICO. Maximum 1MB.
                        </p>

                    </div>

                </div>

            </section>


            <!-- ==========================================
                 SAVE BUTTON
            =========================================== -->
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-7 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Save School Information
                </button>

            </div>

        </form>

    </main>


    <!-- Footer -->
    <footer class="mt-10 border-t border-slate-200 bg-white">

        <div class="mx-auto max-w-6xl px-5 py-5 text-center text-xs text-slate-400">

            © {{ date('Y') }} School Website Admin Panel.

        </div>

    </footer>

</body>
</html>