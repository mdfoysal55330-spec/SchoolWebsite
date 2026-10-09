<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin Dashboard
            </h2>

            <span class="text-sm text-gray-500">
                Welcome, {{ auth()->user()->name }}
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Welcome --}}
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Welcome to Admin Panel
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage your school website from here.
                </p>
            </div>

            {{-- Management Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <a href="#" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">🏫</div>
                    <h3 class="font-semibold text-lg text-gray-800">
                        Site Settings
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        School name, logo, address and contact
                    </p>
                </a>

                <a href="#" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">🖼️</div>
                    <h3 class="font-semibold text-lg text-gray-800">
                        Banner / Slider
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Manage homepage banners
                    </p>
                </a>

                <a href="#" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">📢</div>
                    <h3 class="font-semibold text-lg text-gray-800">
                        Notices
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Add and manage school notices
                    </p>
                </a>

                <a href="#" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">🔗</div>
                    <h3 class="font-semibold text-lg text-gray-800">
                        Custom Links
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Result, Attendance and other links
                    </p>
                </a>

                <a href="#" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">👨‍🏫</div>
                    <h3 class="font-semibold text-lg text-gray-800">
                        Teachers & Staff
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Manage teachers and staff
                    </p>
                </a>

                <a href="#" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">📰</div>
                    <h3 class="font-semibold text-lg text-gray-800">
                        News
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Manage school news
                    </p>
                </a>

                <a href="#" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">📷</div>
                    <h3 class="font-semibold text-lg text-gray-800">
                        Gallery
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Manage school photos
                    </p>
                </a>

                <a href="#" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="text-3xl mb-3">👥</div>
                    <h3 class="font-semibold text-lg text-gray-800">
                        User Management
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Manage admin panel users
                    </p>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>