
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pages Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                    School Website
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Pages Management
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Create and manage important pages of your school website.
                </p>
            </div>

            <div class="flex gap-3">

                <a
                    href="{{ url('/dashboard') }}"
                    class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
                >
                    Dashboard
                </a>

                <button
                    type="button"
                    onclick="document.getElementById('addPageForm').classList.toggle('hidden')"
                    class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                >
                    + Add Page
                </button>

            </div>
        </div>


        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif


        <!-- Add Page Form -->
        <div
            id="addPageForm"
            class="mb-8 hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
        >

            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-900">
                    Add New Page
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Create a new page for your school website.
                </p>
            </div>

            <form
                action="{{ route('admin.pages.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-5"
            >

                @csrf

                <!-- Title -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Page Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        placeholder="Example: About Us"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >

                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Content -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Page Content
                    </label>

                    <textarea
                        name="content"
                        rows="10"
                        placeholder="Write your page content here..."
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >{{ old('content') }}</textarea>

                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Featured Image -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Featured Image
                    </label>

                    <input
                        type="file"
                        name="featured_image"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="block w-full rounded-lg border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-indigo-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100"
                    >

                    <p class="mt-1 text-xs text-slate-400">
                        JPG, PNG or WEBP. Maximum 4MB.
                    </p>

                    @error('featured_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Active -->
                <div>
                    <label class="inline-flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            checked
                            class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                        >

                        <span class="text-sm font-semibold text-slate-700">
                            Active
                        </span>

                    </label>
                </div>


                <!-- Buttons -->
                <div class="flex justify-end gap-3 border-t border-slate-100 pt-5">

                    <button
                        type="button"
                        onclick="document.getElementById('addPageForm').classList.add('hidden')"
                        class="rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                    >
                        Save Page
                    </button>

                </div>

            </form>

        </div>


        <!-- Pages List -->
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-5">

                <h2 class="text-lg font-bold text-slate-900">
                    All Pages
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Manage your school website pages.
                </p>

            </div>


            @if($pages->count())

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Title
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Slug
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Image
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach($pages as $page)

                                <tr class="transition hover:bg-slate-50">

                                    <!-- Title -->
                                    <td class="px-6 py-4">

                                        <div class="font-semibold text-slate-900">
                                            {{ $page->title }}
                                        </div>

                                    </td>


                                    <!-- Slug -->
                                    <td class="px-6 py-4">

                                        <span class="rounded-md bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                            /{{ $page->slug }}
                                        </span>

                                    </td>


                                    <!-- Image -->
                                    <td class="px-6 py-4">

                                        @if($page->featured_image)

                                            <img
                                                src="{{ asset($page->featured_image) }}"
                                                alt="{{ $page->title }}"
                                                class="h-14 w-24 rounded-lg object-cover"
                                            >

                                        @else

                                            <span class="text-xs font-medium text-slate-400">
                                                No Image
                                            </span>

                                        @endif

                                    </td>


                                    <!-- Status -->
                                    <td class="px-6 py-4">

                                        @if($page->is_active)

                                            <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                Active
                                            </span>

                                        @else

                                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    <!-- Action -->
                                    <td class="px-6 py-4">

                                        <div class="flex justify-end gap-2">

                                            <a
                                                href="{{ route('admin.pages.edit', $page) }}"
                                                class="inline-flex items-center rounded-lg bg-indigo-50 px-3 py-2 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                action="{{ route('admin.pages.destroy', $page) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this page?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <!-- Empty State -->
                <div class="px-6 py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-2xl">
                        📄
                    </div>

                    <h3 class="mt-5 text-lg font-bold text-slate-900">
                        No Pages Added Yet
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                        Start by adding your first school website page.
                    </p>

                </div>

            @endif

        </div>

    </div>

</body>
</html>
