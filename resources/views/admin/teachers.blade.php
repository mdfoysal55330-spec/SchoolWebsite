
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Teachers</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50">

<div class="min-h-screen bg-slate-50 py-10">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Teachers
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Manage your school's teachers and staff information.
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

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Teachers List -->
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


            <!-- List Header -->
            <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Teacher List
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $teachers->count() }} teacher(s) found.
                    </p>

                </div>


                <button
                    type="button"
                    onclick="document.getElementById('addTeacherForm').classList.toggle('hidden')"
                    class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                >
                    + Add Teacher
                </button>

            </div>


            <!-- Add Teacher Form -->
            <div
                id="addTeacherForm"
                class="hidden border-b border-slate-200 bg-slate-50 px-6 py-6"
            >

                <h3 class="mb-5 text-lg font-bold text-slate-900">
                    Add New Teacher
                </h3>


                <form
                    method="POST"
                    action="{{ route('admin.teachers.store') }}"
                    enctype="multipart/form-data"
                    class="grid gap-5 md:grid-cols-2"
                >

                    @csrf


                    <!-- Name -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Teacher Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            placeholder="Enter teacher name"
                        >

                    </div>


                    <!-- Designation -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Designation
                        </label>

                        <input
                            type="text"
                            name="designation"
                            value="{{ old('designation') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            placeholder="e.g. Assistant Teacher"
                        >

                    </div>


                    <!-- Subject -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Subject
                        </label>

                        <input
                            type="text"
                            name="subject"
                            value="{{ old('subject') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            placeholder="e.g. Mathematics"
                        >

                    </div>


                    <!-- Phone -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            placeholder="Teacher phone number"
                        >

                    </div>


                    <!-- Email -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            placeholder="Teacher email"
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


                    <!-- Photo -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Teacher Photo
                        </label>

                        <input
                            type="file"
                            name="photo"
                            accept="image/jpeg,image/png,image/webp"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm"
                        >

                        <p class="mt-2 text-xs text-slate-500">
                            JPG, PNG or WEBP. Maximum 2MB.
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
                                Active Teacher
                            </span>

                        </label>

                    </div>


                    <!-- Buttons -->
                    <div class="flex gap-3 md:col-span-2">

                        <button
                            type="submit"
                            class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                        >
                            Save Teacher
                        </button>


                        <button
                            type="button"
                            onclick="document.getElementById('addTeacherForm').classList.add('hidden')"
                            class="rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        >
                            Cancel
                        </button>

                    </div>

                </form>

            </div>


            <!-- Teacher Table -->
            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Photo
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Name
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Designation
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Subject
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 bg-white">


                        @forelse($teachers as $teacher)

                            <tr class="transition hover:bg-slate-50">


                                <!-- Photo -->
                                <td class="px-6 py-4">

                                    @if($teacher->photo)

                                        <img
                                            src="{{ asset($teacher->photo) }}"
                                            alt="{{ $teacher->name }}"
                                            class="h-12 w-12 rounded-xl object-cover"
                                        >

                                    @else

                                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-sm font-bold text-indigo-600">

                                            {{ strtoupper(substr($teacher->name, 0, 1)) }}

                                        </div>

                                    @endif

                                </td>


                                <!-- Name -->
                                <td class="px-6 py-4">

                                    <div class="font-semibold text-slate-900">
                                        {{ $teacher->name }}
                                    </div>

                                    @if($teacher->email)

                                        <div class="mt-1 text-xs text-slate-500">
                                            {{ $teacher->email }}
                                        </div>

                                    @endif

                                </td>


                                <!-- Designation -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $teacher->designation ?: '—' }}
                                </td>


                                <!-- Subject -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $teacher->subject ?: '—' }}
                                </td>


                                <!-- Status -->
                                <td class="px-6 py-4">

                                    @if($teacher->is_active)

                                        <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                            Active
                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                
                                <!-- Action -->
                                <td class="px-6 py-4 text-right">

                                    <div class="flex items-center justify-end gap-2">

                                        <!-- Edit -->
                                        <a
                                            href="{{ route('admin.teachers.edit', $teacher) }}"
                                            class="inline-flex items-center rounded-lg bg-indigo-50 px-3 py-2 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100"
                                        >
                                            Edit
                                        </a>


                                        <!-- Delete -->
                                        <form
                                            action="{{ route('admin.teachers.destroy', $teacher) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this teacher?');"
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


                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                        <svg
                                            class="h-7 w-7"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zm7-3a4 4 0 110 8m4 5v-2a4 4 0 00-3-3.87"
                                            />

                                        </svg>

                                    </div>


                                    <h3 class="mt-4 text-lg font-bold text-slate-900">
                                        No teachers yet
                                    </h3>


                                    <p class="mt-2 text-sm text-slate-500">
                                        Click “Add Teacher” to add your first teacher.
                                    </p>

                                </td>

                            </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>
