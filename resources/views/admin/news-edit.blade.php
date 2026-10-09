
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit News</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex items-center justify-between gap-4">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                    School Website
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Edit News
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Update the selected news information.
                </p>
            </div>

            <a
                href="{{ route('admin.news.index') }}"
                class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
            >
                Back to News
            </a>

        </div>


        <!-- Form -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <form
                action="{{ route('admin.news.update', $news) }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
            >

                @csrf
                @method('PUT')


                <!-- Title -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        News Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $news->title) }}"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >

                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Description -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="6"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >{{ old('description', $news->description) }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Current Image -->
                @if($news->image)

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Current Image
                        </label>

                        <img
                            src="{{ asset($news->image) }}"
                            alt="{{ $news->title }}"
                            class="h-48 w-full max-w-md rounded-xl object-cover"
                        >
                    </div>

                @endif


                <!-- New Image -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Change Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="block w-full rounded-lg border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-indigo-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100"
                    >

                    <p class="mt-1 text-xs text-slate-400">
                        Leave empty to keep the current image.
                    </p>

                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Date + Sort -->
                <div class="grid gap-5 md:grid-cols-2">

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Publish Date
                        </label>

                        <input
                            type="date"
                            name="publish_date"
                            value="{{ old('publish_date', \Carbon\Carbon::parse($news->publish_date)->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >

                        @error('publish_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order', $news->sort_order) }}"
                            min="0"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >

                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                <!-- Active -->
                <div>

                    <label class="inline-flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $news->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                        >

                        <span class="text-sm font-semibold text-slate-700">
                            Active
                        </span>

                    </label>

                </div>


                <!-- Buttons -->
                <div class="flex justify-end gap-3 border-t border-slate-100 pt-6">

                    <a
                        href="{{ route('admin.news.index') }}"
                        class="rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                    >
                        Update News
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>
