<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Banner</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">

    <div class="min-h-screen">

        <!-- Header -->
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-5">

                <div>
                    <h1 class="text-2xl font-bold text-slate-900">
                        Edit Banner
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Update your homepage banner
                    </p>
                </div>

                <a
                    href="{{ route('admin.banners.index') }}"
                    class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50"
                >
                    ← Back to Banners
                </a>

            </div>
        </header>


        <!-- Main -->
        <main class="mx-auto max-w-5xl px-6 py-8">

            @if($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <form
                    action="{{ route('admin.banners.update', $banner) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6"
                >

                    @csrf
                    @method('PUT')


                    <!-- Current Image -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Current Banner
                        </label>

                        <img
                            src="{{ asset($banner->image) }}"
                            alt="{{ $banner->title ?? 'Banner' }}"
                            class="h-48 w-full rounded-xl object-cover md:w-96"
                        >
                    </div>


                    <!-- New Image -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Replace Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm"
                        >

                        <p class="mt-1 text-xs text-slate-500">
                            Leave empty to keep the current image.
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
                            value="{{ old('title', $banner->title) }}"
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
                            rows="4"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-500 focus:outline-none"
                        >{{ old('subtitle', $banner->subtitle) }}</textarea>
                    </div>


                    <!-- Order -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Display Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            min="0"
                            value="{{ old('sort_order', $banner->sort_order) }}"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-500 focus:outline-none"
                        >
                    </div>


                    <!-- Active -->
                    <div>
                        <label class="flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $banner->is_active) ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-slate-300"
                            >

                            <span class="text-sm font-medium text-slate-700">
                                Active Banner
                            </span>

                        </label>
                    </div>


                    <!-- Buttons -->
                    <div class="flex items-center gap-3 pt-2">

                        <button
                            type="submit"
                            class="rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-800"
                        >
                            Update Banner
                        </button>

                        <a
                            href="{{ route('admin.banners.index') }}"
                            class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50"
                        >
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </main>

    </div>

</body>
</html>