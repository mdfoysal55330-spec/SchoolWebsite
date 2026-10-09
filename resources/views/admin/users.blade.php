<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Access | Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-5 lg:px-8">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-indigo-600">Settings</p>
                <h1 class="mt-1 text-2xl font-bold text-slate-900">User Access</h1>
                <p class="mt-1 text-sm text-slate-500">Create accounts and choose which admin sections each user can manage.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="shrink-0 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Dashboard
            </a>
        </div>
    </header>

    <main class="mx-auto grid max-w-7xl gap-6 px-5 py-8 lg:grid-cols-[minmax(280px,0.8fr)_minmax(0,1.6fr)] lg:px-8">
        @if(session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 lg:col-span-2">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 lg:col-span-2">
                <ul class="list-inside list-disc space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="h-fit rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900">Create user</h2>
            <p class="mt-1 text-sm text-slate-500">Choose at least one section this account can access.</p>

            <form method="POST" action="{{ route('admin.users.store') }}" class="mt-5 space-y-4">
                @csrf

                <div>
                    <label for="name" class="mb-1 block text-sm font-semibold text-slate-700">Full name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="255" autocomplete="name" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="mb-1 block text-sm font-semibold text-slate-700">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="mb-1 block text-sm font-semibold text-slate-700">Password</label>
                    <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-1 block text-sm font-semibold text-slate-700">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                </div>

                <fieldset>
                    <legend class="mb-2 text-sm font-semibold text-slate-700">Allowed sections</legend>
                    <div class="space-y-2">
                        @foreach($permissions as $key => $label)
                            <label class="flex items-center gap-2 text-sm text-slate-600">
                                <input type="checkbox" name="permissions[]" value="{{ $key }}" @checked(in_array($key, old('permissions', []), true)) class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    @error('permissions') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
                    @error('permissions.*') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
                </fieldset>

                <button type="submit" class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Create user
                </button>
            </form>
        </section>

        <section class="min-w-0 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-5">
                <h2 class="text-lg font-bold text-slate-900">Existing users</h2>
                <p class="mt-1 text-sm text-slate-500">Edit section access or remove an account.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs uppercase tracking-wide text-slate-500">
                            <th class="px-3 py-3 font-bold">User</th>
                            <th class="px-3 py-3 font-bold">Access</th>
                            <th class="px-3 py-3 text-right font-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-3 py-4 align-top">
                                    <p class="font-semibold text-slate-900">
                                        {{ $user->name }}
                                        @if($user->is(auth()->user()))
                                            <span class="ml-1 text-xs font-normal text-slate-500">(you)</span>
                                        @endif
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">{{ $user->email }}</p>
                                </td>
                                <td class="max-w-sm px-3 py-4">
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($permissions as $key => $label)
                                            @if($user->hasAdminPermission($key))
                                                <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700">{{ $label }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-right align-top">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="font-semibold text-indigo-600 hover:text-indigo-800">Edit</a>
                                    @if(!$user->is(auth()->user()))
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mt-2" onsubmit="return confirm('Delete this user account?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-semibold text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 py-8 text-center text-slate-500">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5">{{ $users->links() }}</div>
        </section>
    </main>
</body>
</html>
