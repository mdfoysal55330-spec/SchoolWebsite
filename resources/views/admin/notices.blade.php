<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Notices</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">

<div class="min-h-screen">

    <!-- Header -->
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">

            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    Manage Notices
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Add and manage school notices
                </p>
            </div>

            <a
                href="{{ route('dashboard') }}"
                class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50"
            >
                ← Dashboard
            </a>

        </div>
    </header>


    <!-- Main -->
    <main class="mx-auto max-w-7xl px-6 py-8">

        <!-- Success -->
        @if(session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif


        <!-- Errors -->
        @if($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

                <ul class="list-disc space-y-1 pl-5">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif


        <!-- Add Notice -->
        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6">

                <h2 class="text-lg font-semibold text-slate-900">
                    Add New Notice
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Create a notice using an image, PDF or external link.
                </p>

            </div>


            <form
                action="{{ route('admin.notices.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-5"
            >

                @csrf


                <!-- Title -->
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Notice Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        placeholder="Example: Annual Examination Notice"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-500 focus:outline-none"
                    >

                </div>


                <!-- Type -->
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Notice Type
                    </label>

                    <select
                        name="type"
                        id="noticeType"
                        required
                        onchange="toggleNoticeFields()"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-slate-500 focus:outline-none"
                    >

                        <option value="">Select Type</option>

                        <option value="image" {{ old('type') === 'image' ? 'selected' : '' }}>
                            Image
                        </option>

                        <option value="pdf" {{ old('type') === 'pdf' ? 'selected' : '' }}>
                            PDF
                        </option>

                        <option value="link" {{ old('type') === 'link' ? 'selected' : '' }}>
                            External Link
                        </option>

                    </select>

                </div>


                <!-- File -->
                <div id="fileField">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Notice File
                    </label>

                    <input
                        type="file"
                        name="file"
                        accept=".jpg,.jpeg,.png,.webp,.pdf"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm"
                    >

                    <p class="mt-1 text-xs text-slate-500">
                        Image: JPG, JPEG, PNG, WEBP | PDF: PDF | Maximum 5MB
                    </p>

                </div>


                <!-- External URL -->
                <div id="linkField" class="hidden">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        External URL
                    </label>

                    <input
                        type="url"
                        name="external_url"
                        value="{{ old('external_url') }}"
                        placeholder="https://example.com/notice"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-500 focus:outline-none"
                    >

                </div>


                <!-- Publish Date -->
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Publish Date
                    </label>

                    <input
                        type="date"
                        name="publish_date"
                        value="{{ old('publish_date', date('Y-m-d')) }}"
                        required
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
                            checked
                            class="h-4 w-4 rounded border-slate-300"
                        >

                        <span class="text-sm font-medium text-slate-700">
                            Active Notice
                        </span>

                    </label>

                </div>


                <!-- Submit -->
                <div class="pt-2">

                    <button
                        type="submit"
                        class="rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-800"
                    >
                        Add Notice
                    </button>

                </div>

            </form>

        </div>


        <!-- Existing Notices -->
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <h2 class="text-lg font-semibold text-slate-900">
                    Existing Notices
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Manage published and unpublished notices.
                </p>

            </div>


            @if($notices->count())

                <div class="divide-y divide-slate-200">

                    @foreach($notices as $notice)

                        <div class="flex flex-col gap-5 p-6 md:flex-row md:items-center md:justify-between">

                            <!-- Notice Info -->
                            <div>

                                <h3 class="font-semibold text-slate-900">
                                    {{ $notice->title }}
                                </h3>


                                <div class="mt-2 flex flex-wrap items-center gap-2 text-xs">

                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-slate-600">
                                        {{ strtoupper($notice->type) }}
                                    </span>

                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-slate-600">
                                        {{ \Carbon\Carbon::parse($notice->publish_date)->format('d M Y') }}
                                    </span>


                                    @if($notice->is_active)

                                        <span class="rounded-full bg-green-100 px-2.5 py-1 text-green-700">
                                            Active
                                        </span>

                                    @else

                                        <span class="rounded-full bg-red-100 px-2.5 py-1 text-red-700">
                                            Inactive
                                        </span>

                                    @endif

                                </div>


                                <!-- View -->
                                <div class="mt-3">

                                    @if($notice->type === 'link' && $notice->external_url)

                                        <a
                                            href="{{ $notice->external_url }}"
                                            target="_blank"
                                            class="text-sm font-medium text-blue-600 hover:underline"
                                        >
                                            Open Link →
                                        </a>

                                    @elseif($notice->file_path)

                                        <a
                                            href="{{ asset($notice->file_path) }}"
                                            target="_blank"
                                            class="text-sm font-medium text-blue-600 hover:underline"
                                        >
                                            View Notice →
                                        </a>

                                    @endif

                                </div>

                            </div>


                            <!-- Actions -->
                            <div class="flex items-center gap-2">

                                <a
                                    href="{{ route('admin.notices.edit', $notice) }}"
                                    class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('admin.notices.destroy', $notice) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this notice?');"
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
                        No notices have been added yet.
                    </p>

                </div>

            @endif

        </div>

    </main>

</div>


<script>
    function toggleNoticeFields() {

        const type = document.getElementById('noticeType').value;

        const fileField = document.getElementById('fileField');
        const linkField = document.getElementById('linkField');

        if (type === 'link') {

            fileField.classList.add('hidden');
            linkField.classList.remove('hidden');

        } else {

            fileField.classList.remove('hidden');
            linkField.classList.add('hidden');

        }
    }

    document.addEventListener('DOMContentLoaded', toggleNoticeFields);
</script>

</body>
</html>