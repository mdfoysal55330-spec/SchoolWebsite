<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Banners</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">

    <div class="min-h-screen">

        <!-- Header -->
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">

                <div>
                    <h1 class="text-2xl font-bold text-slate-900">
                        Manage Banners
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Add and manage homepage banners
                    </p>
                </div>

                <a
                    href="{{ route('dashboard') }}"
                    class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                >
                    ← Dashboard
                </a>

            </div>
        </header>


        <!-- Main -->
        <main class="mx-auto max-w-7xl px-6 py-8">

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif


            <!-- Validation Errors -->
            @if($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- Add Banner -->
            <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-slate-900">
                        Add New Banner
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Upload a banner image and add optional text.
                    </p>
                </div>


                <form
                    action="{{ route('admin.banners.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-5"
                >

                    @csrf


                    <!-- Image -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Banner Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                            required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm"
                        >

                        <p class="mt-1 text-xs text-slate-500">
                            JPG, JPEG, PNG or WEBP. Maximum 4MB.
                        </p>
                    </div>


                    <!-- Title -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Welcome to our school"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-500 focus:outline-none"
                        >
                    </div>


                    <!-- Subtitle -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Subtitle
                        </label>

                        <textarea
                            name="subtitle"
                            rows="3"
                            placeholder="A short description for this banner"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-500 focus:outline-none"
                        >{{ old('subtitle') }}</textarea>
                    </div>


                    <!-- Order + Active -->
                    <div class="grid gap-5 md:grid-cols-2">

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">
                                Display Order
                            </label>

                            <input
                                type="number"
                                name="sort_order"
                                value="{{ old('sort_order', 0) }}"
                                min="0"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-500 focus:outline-none"
                            >
                        </div>


                        <div class="flex items-center pt-8">

                            <label class="flex cursor-pointer items-center gap-3">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    checked
                                    class="h-4 w-4 rounded border-slate-300"
                                >

                                <span class="text-sm font-medium text-slate-700">
                                    Active Banner
                                </span>

                            </label>

                        </div>

                    </div>


                    <!-- Submit -->
                    <div class="pt-2">

                        <button
                            type="submit"
                            class="rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800"
                        >
                            Add Banner
                        </button>

                    </div>

                </form>

            </div>


            <!-- Existing Banners -->
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-5">

                    <h2 class="text-lg font-semibold text-slate-900">
                        Existing Banners
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Manage your homepage banners.
                    </p>

                </div>


                @if($banners->count())

                    <div class="divide-y divide-slate-200">

                        @foreach($banners as $banner)

                            <div class="flex flex-col gap-5 p-6 md:flex-row md:items-center md:justify-between">

                                <!-- Preview -->
                                <div class="flex items-center gap-5">

                                    <img
                                        src="{{ asset($banner->image) }}"
                                        alt="{{ $banner->title ?? 'Banner' }}"
                                        class="h-24 w-40 rounded-lg object-cover"
                                    >

                                    <div>

                                        <h3 class="font-semibold text-slate-900">
                                            {{ $banner->title ?: 'Untitled Banner' }}
                                        </h3>

                                        @if($banner->subtitle)
                                            <p class="mt-1 max-w-xl text-sm text-slate-500">
                                                {{ $banner->subtitle }}
                                            </p>
                                        @endif

                                        <div class="mt-2 flex items-center gap-3 text-xs">

                                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-slate-600">
                                                Order: {{ $banner->sort_order }}
                                            </span>

                                            @if($banner->is_active)
                                                <span class="rounded-full bg-green-100 px-2.5 py-1 text-green-700">
                                                    Active
                                                </span>
                                            @else
                                                <span class="rounded-full bg-red-100 px-2.5 py-1 text-red-700">
                                                    Inactive
                                                </span>
                                            @endif

                                        </div>

                                    </div>

                                </div>


                                <!-- Actions -->
                                <div class="flex items-center gap-2">

                                    <a
                                        href="{{ route('admin.banners.edit', $banner) }}"
                                        class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('admin.banners.destroy', $banner) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this banner?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-12 text-center">

                        <p class="text-sm text-slate-500">
                            No banners have been added yet.
                        </p>

                    </div>

                @endif

            </div>

        </main>

    </div>

</body>
</html>