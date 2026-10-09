<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Access | Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-4xl items-center justify-between gap-4 px-5 py-5">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-indigo-600">Settings / User Access</p>
                <h1 class="mt-1 text-2xl font-bold text-slate-900">Edit user</h1>
                <p class="mt-1 text-sm text-slate-500">Update account details and allowed admin sections.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="shrink-0 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Back to users
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-5 py-8">
        @if($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-inside list-disc space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="name" class="mb-1 block text-sm font-semibold text-slate-700">Full name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required maxlength="255" autocomplete="name" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="mb-1 block text-sm font-semibold text-slate-700">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required maxlength="255" autocomplete="email" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="mb-1 block text-sm font-semibold text-slate-700">New password <span class="font-normal text-slate-500">(leave blank to keep current)</span></label>
                    <input id="password" name="password" type="password" minlength="8" autocomplete="new-password" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-1 block text-sm font-semibold text-slate-700">Confirm new password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" autocomplete="new-password" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                </div>
            </div>

            <fieldset>
                <legend class="mb-3 text-sm font-semibold text-slate-700">Allowed sections</legend>
                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($permissions as $key => $label)
                        <label class="flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-700">
                            <input type="checkbox" name="permissions[]" value="{{ $key }}" @checked(in_array($key, old('permissions', $selectedPermissions), true)) class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
                @error('permissions') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
                @error('permissions.*') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
            </fieldset>

            <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-5">
                <a href="{{ route('admin.users.index') }}" class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancel</a>
                <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Save changes
                </button>
            </div>
        </form>
    </main>
</body>
</html>
