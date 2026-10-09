
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Gallery Image</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="min-h-screen px-4 py-10">

    <div class="mx-auto max-w-4xl">

        <!-- Header -->
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Edit Gallery Image
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Update gallery image information.
                </p>
            </div>

            <a
                href="{{ route('admin.gallery.index') }}"
                class="inline-flex items-center justify-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-slate-200 transition hover:bg-slate-100"
            >
                ← Back to Gallery
            </a>

        </div>


        <!-- Form -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

            <form
                method="POST"
                action="{{ route('admin.gallery.update', $gallery) }}"
                enctype="multipart/form-data"
                class="space-y-6"
            >

                @csrf
                @method('PUT')


                <!-- Title -->
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Image Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $gallery->title) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        placeholder="e.g. Annual Sports Day"
                    >

                    @error('title')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Current Image -->
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Current Image
                    </label>

                    <div class="overflow-hidden rounded-xl border border-slate-200 bg-slate-50 sm:w-96">

                        <img
                            src="{{ asset($gallery->image) }}"
                            alt="{{ $gallery->title ?: 'Gallery Image' }}"
                            class="aspect-[4/3] w-full object-cover"
                        >

                    </div>

                </div>


                <!-- New Image -->
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Change Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        accept="image/jpeg,image/png,image/webp"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Leave empty to keep the current image. JPG, PNG or WEBP. Maximum 4MB.
                    </p>

                    @error('image')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Sort Order -->
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old('sort_order', $gallery->sort_order ?? 0) }}"
                        min="0"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >

                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Active -->
                <div class="rounded-xl bg-slate-50 p-4">

                    <label class="inline-flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                            class="h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                        >

                        <span class="text-sm font-semibold text-slate-700">
                            Active Image
                        </span>

                    </label>

                </div>


                <!-- Buttons -->
                <div class="flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('admin.gallery.index') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                    >
                        Update Image
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>
