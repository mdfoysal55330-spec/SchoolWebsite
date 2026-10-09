
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>News Management</title>

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
                    News Management
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Add and manage your school's latest news.
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
                    onclick="document.getElementById('addNewsForm').classList.toggle('hidden')"
                    class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                >
                    + Add News
                </button>

            </div>
        </div>


        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif


        <!-- Add News Form -->
        <div
            id="addNewsForm"
            class="mb-8 hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
        >

            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-900">
                    Add New News
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Enter the news information below.
                </p>
            </div>

            <form
                action="{{ route('admin.news.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-5"
            >

                @csrf

                <div class="grid gap-5 md:grid-cols-2">

                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            News Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            placeholder="Enter news title"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >

                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            placeholder="Write news details..."
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Publish Date -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Publish Date
                        </label>

                        <input
                            type="date"
                            name="publish_date"
                            value="{{ old('publish_date', date('Y-m-d')) }}"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >

                        @error('publish_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
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
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >

                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Image -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            News Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="block w-full rounded-lg border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-indigo-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100"
                        >

                        <p class="mt-1 text-xs text-slate-400">
                            JPG, PNG or WEBP. Maximum 4MB.
                        </p>

                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Active -->
                    <div class="flex items-center pt-8">

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

                </div>


                <!-- Buttons -->
                <div class="flex justify-end gap-3 border-t border-slate-100 pt-5">

                    <button
                        type="button"
                        onclick="document.getElementById('addNewsForm').classList.add('hidden')"
                        class="rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                    >
                        Save News
                    </button>

                </div>

            </form>

        </div>


        <!-- News List -->
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">
                    All News
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Manage your published and unpublished news.
                </p>
            </div>


            @if($news->count())

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Image
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Title
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Publish Date
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

                            @foreach($news as $item)

                                <tr class="transition hover:bg-slate-50">

                                    <!-- Image -->
                                    <td class="px-6 py-4">

                                        @if($item->image)

                                            <img
                                                src="{{ asset($item->image) }}"
                                                alt="{{ $item->title }}"
                                                class="h-16 w-24 rounded-lg object-cover"
                                            >

                                        @else

                                            <div class="flex h-16 w-24 items-center justify-center rounded-lg bg-slate-100 text-xs font-medium text-slate-400">
                                                No Image
                                            </div>

                                        @endif

                                    </td>


                                    <!-- Title -->
                                    <td class="max-w-md px-6 py-4">

                                        <div class="font-semibold text-slate-900">
                                            {{ $item->title }}
                                        </div>

                                        @if($item->description)

                                            <div class="mt-1 line-clamp-2 text-sm text-slate-500">
                                                {{ $item->description }}
                                            </div>

                                        @endif

                                    </td>


                                    <!-- Date -->
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                        {{ \Carbon\Carbon::parse($item->publish_date)->format('d M Y') }}
                                    </td>


                                    <!-- Status -->
                                    <td class="px-6 py-4">

                                        @if($item->is_active)

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
                                                href="{{ route('admin.news.edit', $item) }}"
                                                class="inline-flex items-center rounded-lg bg-indigo-50 px-3 py-2 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                action="{{ route('admin.news.destroy', $item) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this news?');"
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
                        📰
                    </div>

                    <h3 class="mt-5 text-lg font-bold text-slate-900">
                        No News Added Yet
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                        Start by adding your first school news using the
                        <span class="font-semibold text-slate-700">Add News</span>
                        button above.
                    </p>

                </div>

            @endif

        </div>

    </div>

</body>
</html>