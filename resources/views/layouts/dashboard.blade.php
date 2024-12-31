<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inklusi Kerja') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen bg-gray-50 flex flex-col">
        <!-- Include Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content -->
        <div class="md:pl-64 flex flex-col min-h-screen">
            <!-- Navbar -->
            <header class="sticky top-0 z-50 flex h-16 bg-white border-b border-gray-200">
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = true" class="px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-900 md:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>

                <!-- Right section -->
                <div class="flex flex-1 justify-between px-4 md:px-6">
                    <div class="flex flex-1"></div>
                    <div class="ml-4 flex items-center space-x-4 md:ml-6 md:pr-4">
                        <!-- Subscription CTA Button -->
                        @if(!auth()->user()->is_premium)
                            <div x-data="{ showSubsModal: false }">
                                <button @click="showSubsModal = true" 
                                    class="hidden md:inline-flex items-center px-4 py-2 border border-gray-800 text-sm font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                    Upgrade Premium
                                </button>

                                <!-- Subscription Plans Modal -->
                                <div x-show="showSubsModal" 
                                    class="fixed inset-0 z-[70] overflow-y-auto" 
                                    aria-labelledby="modal-title" 
                                    role="dialog" 
                                    aria-modal="true"
                                    style="display: none;">
                                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <!-- Background overlay -->
                                        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" 
                                            aria-hidden="true"
                                            @click="showSubsModal = false"></div>

                                        <!-- Modal panel -->
                                        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full sm:p-6">
                                            <div class="absolute top-0 right-0 pt-4 pr-4">
                                                <button @click="showSubsModal = false" class="text-gray-400 hover:text-gray-500">
                                                    <span class="sr-only">Close</span>
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="text-center mb-8">
                                                <h3 class="text-2xl font-bold text-gray-900" id="modal-title">
                                                    Pilih Paket Berlangganan
                                                </h3>
                                                <p class="mt-2 text-sm text-gray-500">
                                                    Tingkatkan akses Anda dengan berlangganan paket premium
                                                </p>
                                            </div>

                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                <!-- Basic Plan -->
                                                <div class="relative flex flex-col rounded-lg border border-gray-200 bg-white p-6 shadow-sm hover:border-gray-300 hover:shadow-md transition-all duration-200">
                                                    <div class="flex-1">
                                                        <h3 class="text-lg font-semibold text-gray-900">Paket Basic</h3>
                                                        <p class="mt-4 flex items-baseline text-gray-900">
                                                            <span class="text-3xl font-bold tracking-tight">Rp50.000</span>
                                                            <span class="ml-1 text-sm font-semibold text-gray-500">/bulan</span>
                                                        </p>
                                                        <p class="mt-6 text-gray-500">Ideal untuk pencari kerja pemula</p>

                                                        <ul role="list" class="mt-6 space-y-4">
                                                            <li class="flex space-x-3">
                                                                <svg class="h-5 w-5 flex-shrink-0 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                </svg>
                                                                <span class="text-sm text-gray-500">Maksimal 15 lamaran per hari</span>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <a href="{{ route('subscription.checkout', ['plan' => 1]) }}" 
                                                        class="mt-8 block w-full rounded-lg border border-gray-800 bg-white py-2 text-center text-sm font-semibold text-gray-800 hover:bg-gray-50">
                                                        Pilih Paket Basic
                                                    </a>
                                                </div>

                                                <!-- Professional Plan -->
                                                <div class="relative flex flex-col rounded-lg border-2 border-gray-800 bg-white p-6 shadow-md hover:shadow-lg transition-all duration-200">
                                                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 rounded-full bg-gray-800 px-4 py-1 text-sm font-semibold text-white">
                                                        Popular
                                                    </div>
                                                    <div class="flex-1">
                                                        <h3 class="text-lg font-semibold text-gray-900">Paket Professional</h3>
                                                        <p class="mt-4 flex items-baseline text-gray-900">
                                                            <span class="text-3xl font-bold tracking-tight">Rp100.000</span>
                                                            <span class="ml-1 text-sm font-semibold text-gray-500">/bulan</span>
                                                        </p>
                                                        <p class="mt-6 text-gray-500">Untuk pencari kerja yang serius</p>

                                                        <ul role="list" class="mt-6 space-y-4">
                                                            <li class="flex space-x-3">
                                                                <svg class="h-5 w-5 flex-shrink-0 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                </svg>
                                                                <span class="text-sm text-gray-500">Maksimal 30 lamaran per hari</span>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <a href="{{ route('subscription.checkout', ['plan' => 2]) }}" 
                                                        class="mt-8 block w-full rounded-lg border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-700">
                                                        Pilih Paket Professional
                                                    </a>
                                                </div>

                                                <!-- Ultimate Plan -->
                                                <div class="relative flex flex-col rounded-lg border border-gray-200 bg-white p-6 shadow-sm hover:border-gray-300 hover:shadow-md transition-all duration-200">
                                                    <div class="flex-1">
                                                        <h3 class="text-lg font-semibold text-gray-900">Paket Ultimate</h3>
                                                        <p class="mt-4 flex items-baseline text-gray-900">
                                                            <span class="text-3xl font-bold tracking-tight">Rp150.000</span>
                                                            <span class="ml-1 text-sm font-semibold text-gray-500">/bulan</span>
                                                        </p>
                                                        <p class="mt-6 text-gray-500">Untuk akses tanpa batas</p>

                                                        <ul role="list" class="mt-6 space-y-4">
                                                            <li class="flex space-x-3">
                                                                <svg class="h-5 w-5 flex-shrink-0 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                </svg>
                                                                <span class="text-sm text-gray-500">Lamaran tidak terbatas</span>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <a href="{{ route('subscription.checkout', ['plan' => 3]) }}" 
                                                        class="mt-8 block w-full rounded-lg border border-gray-800 bg-white py-2 text-center text-sm font-semibold text-gray-800 hover:bg-gray-50">
                                                        Pilih Paket Ultimate
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Premium Badge -->
                        @if(auth()->user()->is_premium && auth()->user()->premium_expires_at > now())
                            <div class="hidden md:flex items-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                    Premium
                                </span>
                            </div>
                        @endif

                        <!-- Profile dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-full">
                                <div class="flex items-center space-x-3">
                                    <img class="h-8 w-8 rounded-full object-cover border-2 border-gray-200" 
                                         src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset('images/logo.png') }}" 
                                         alt="{{ auth()->user()->name }}">
                                    <div class="hidden md:flex md:items-center">
                                        <span class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</span>
                                        <svg class="ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </button>

                            <!-- Dropdown menu -->
                            <div x-show="open" 
                                @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-3 w-56 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                                role="menu">
                                <div class="px-1 py-1">
                                    <a href="{{ route('profile.edit') }}" 
                                        class="group flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-150" 
                                        role="menuitem">
                                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profil Saya
                                    </a>
                                </div>
                                <div class="px-1 py-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" 
                                            class="group flex w-full items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-150" 
                                            role="menuitem">
                                            <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Wrapper -->
            <main class="flex-1 p-6 relative z-0">
                <!-- Page Content -->
                <div class="space-y-6">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-auto relative z-0">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
                    <div class="flex justify-center space-x-6 md:order-2">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                    <div class="mt-4 md:mt-0 md:order-1">
                        <p class="text-center text-sm text-gray-400">
                            &copy; {{ date('Y') }} {{ config('app.name', 'Inklusi Kerja') }}. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html> 