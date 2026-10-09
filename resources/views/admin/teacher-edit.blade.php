
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Teacher</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <div class="min-h-screen py-10 px-4">

        <div class="mx-auto max-w-4xl">

            <!-- Header -->
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h1 class="text-3xl font-bold text-slate-800">
                        Edit Teacher
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Update teacher information
                    </p>
                </div>

                <a
                    href="{{ route('admin.teachers.index') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-slate-200 transition hover:bg-slate-100"
                >
                    ← Back to Teachers
                </a>

            </div>


            <!-- Form Card -->
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

                <form
                    action="{{ route('admin.teachers.update', $teacher) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6"
                >

                    @csrf
                    @method('PUT')


                    <!-- Name -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Teacher Name *
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $teacher->name) }}"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            placeholder="Enter teacher name"
                        >

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- Designation + Subject -->
                    <div class="grid gap-6 md:grid-cols-2">

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Designation
                            </label>

                            <input
                                type="text"
                                name="designation"
                                value="{{ old('designation', $teacher->designation) }}"
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                placeholder="e.g. Senior Teacher"
                            >

                            @error('designation')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Subject
                            </label>

                            <input
                                type="text"
                                name="subject"
                                value="{{ old('subject', $teacher->subject) }}"
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                placeholder="e.g. Mathematics"
                            >

                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>


                    <!-- Phone + Email -->
                    <div class="grid gap-6 md:grid-cols-2">

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Phone
                            </label>

                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone', $teacher->phone) }}"
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                placeholder="01XXXXXXXXX"
                            >

                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $teacher->email) }}"
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                placeholder="teacher@example.com"
                            >

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>


                    <!-- Sort Order -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order', $teacher->sort_order ?? 0) }}"
                            min="0"
                            class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                        >

                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- Current Photo -->
                    @if($teacher->photo)

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Current Photo
                            </label>

                            <img
                                src="{{ asset($teacher->photo) }}"
                                alt="{{ $teacher->name }}"
                                class="h-28 w-28 rounded-xl object-cover ring-1 ring-slate-200"
                            >
                        </div>

                    @endif


                    <!-- New Photo -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Change Photo
                        </label>

                        <input
                            type="file"
                            name="photo"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="block w-full rounded-lg border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200"
                        >

                        <p class="mt-1 text-xs text-slate-500">
                            JPG, JPEG, PNG or WEBP. Maximum 2MB.
                        </p>

                        @error('photo')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- Active -->
                    <div class="rounded-lg bg-slate-50 p-4">

                        <label class="flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $teacher->is_active) ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-slate-300"
                            >

                            <span class="text-sm font-semibold text-slate-700">
                                Active Teacher
                            </span>

                        </label>

                    </div>


                    <!-- Buttons -->
                    <div class="flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('admin.teachers.index') }}"
                            class="inline-flex items-center justify-center rounded-lg bg-slate-100 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                        >
                            Update Teacher
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>
