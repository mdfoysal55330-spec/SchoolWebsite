
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gallery</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50">

<div class="min-h-screen bg-slate-50 py-10">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Gallery
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Manage your school's photo gallery.
                </p>
            </div>

            <a
                href="{{ url('/dashboard') }}"
                class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
            >
                ← Dashboard
            </a>

        </div>


        <!-- Success Message -->
        @if(session('success'))

            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>

        @endif


        <!-- Error Message -->
        @if($errors->any())

            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

                <ul class="list-disc space-y-1 pl-5">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Main Card -->
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


            <!-- Card Header -->
            <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Photo Gallery
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $galleries->count() }} image(s) found.
                    </p>

                </div>


                <button
                    type="button"
                    onclick="document.getElementById('addGalleryForm').classList.toggle('hidden')"
                    class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                >
                    + Add Image
                </button>

            </div>


            <!-- Add Gallery Form -->
            <div
                id="addGalleryForm"
                class="hidden border-b border-slate-200 bg-slate-50 px-6 py-6"
            >

                <h3 class="mb-5 text-lg font-bold text-slate-900">
                    Add New Gallery Image
                </h3>


                <form
                    method="POST"
                    action="{{ route('admin.gallery.store') }}"
                    enctype="multipart/form-data"
                    class="grid gap-5 md:grid-cols-2"
                >

                    @csrf


                    <!-- Title -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Image Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            placeholder="e.g. Annual Sports Day"
                        >

                    </div>


                    <!-- Sort Order -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >

                    </div>


                    <!-- Image -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Image *
                        </label>

                        <input
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                            required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm"
                        >

                        <p class="mt-2 text-xs text-slate-500">
                            JPG, PNG or WEBP. Maximum 4MB.
                        </p>

                    </div>


                    <!-- Active -->
                    <div class="flex items-center">

                        <label class="inline-flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                checked
                                class="h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                            >

                            <span class="text-sm font-semibold text-slate-700">
                                Active Image
                            </span>

                        </label>

                    </div>


                    <!-- Buttons -->
                    <div class="flex gap-3 md:col-span-2">

                        <button
                            type="submit"
                            class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                        >
                            Save Image
                        </button>


                        <button
                            type="button"
                            onclick="document.getElementById('addGalleryForm').classList.add('hidden')"
                            class="rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        >
                            Cancel
                        </button>

                    </div>

                </form>

            </div>


            <!-- Gallery Grid -->
            <div class="p-6">

                @if($galleries->count())

                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                        @foreach($galleries as $gallery)

                            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">

                                <!-- Image -->
                                <div class="aspect-[4/3] overflow-hidden bg-slate-100">

                                    <img
                                        src="{{ asset($gallery->image) }}"
                                        alt="{{ $gallery->title ?: 'Gallery Image' }}"
                                        class="h-full w-full object-cover transition duration-300 hover:scale-105"
                                    >

                                </div>


                                <!-- Content -->
                                <div class="p-4">

                                    <div class="flex items-start justify-between gap-3">

                                        <div class="min-w-0">

                                            <h3 class="truncate font-bold text-slate-900">
                                                {{ $gallery->title ?: 'Untitled Image' }}
                                            </h3>

                                            <p class="mt-1 text-xs text-slate-500">
                                                Sort Order: {{ $gallery->sort_order }}
                                            </p>

                                        </div>


                                        @if($gallery->is_active)

                                            <span class="shrink-0 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                                Active
                                            </span>

                                        @else

                                            <span class="shrink-0 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">
                                                Inactive
                                            </span>

                                        @endif

                                    </div>


                                    <!-- Actions -->
                                    <div class="mt-4 flex gap-2">

                                        <a
                                            href="{{ route('admin.gallery.edit', $gallery) }}"
                                            class="flex-1 rounded-lg bg-indigo-50 px-3 py-2 text-center text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100"
                                        >
                                            Edit
                                        </a>


                                        <form
                                            action="{{ route('admin.gallery.destroy', $gallery) }}"
                                            method="POST"
                                            class="flex-1"
                                            onsubmit="return confirm('Are you sure you want to delete this image?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="w-full rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <!-- Empty State -->
                    <div class="py-16 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                            <svg
                                class="h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2zm3-10h.01"
                                />

                            </svg>

                        </div>


                        <h3 class="mt-4 text-lg font-bold text-slate-900">
                            No gallery images yet
                        </h3>


                        <p class="mt-2 text-sm text-slate-500">
                            Click “Add Image” to upload your first gallery image.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

</body>
</html>
