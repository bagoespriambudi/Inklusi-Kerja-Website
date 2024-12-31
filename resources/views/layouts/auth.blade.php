<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inklusi Kerja') }} - @yield('title', 'Authentication')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
    <div class="min-h-screen flex">
        <!-- Left Section - Background Image & Copy -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-black items-center">
            <!-- Background image from Unsplash - Modern office workspace -->
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')] bg-cover bg-center opacity-50"></div>
            
            <!-- Dark overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/70 to-black/90"></div>
            
            <!-- Content -->
            <div class="relative z-10 p-12 flex flex-col h-full">
                <!-- Logo Area -->
                <div class="flex-none">
                    <a href="/" class="inline-block">
                        <img src="{{ asset('images/logo-white.png') }}" alt="{{ config('app.name') }}" class="h-8">
                    </a>
                </div>

                <!-- Main Copy - Vertically centered -->
                <div class="flex-1 flex items-center">
                    <div class="space-y-6 max-w-lg">
                        <h1 class="text-4xl font-bold tracking-tight text-white">
                            Temukan Peluang Karir Inklusif Anda
                        </h1>
                        <p class="text-xl text-gray-300 leading-relaxed">
                            Platform khusus yang menghubungkan talenta difabel dengan perusahaan-perusahaan terkemuka di Indonesia.
                        </p>
                        <div class="flex flex-col space-y-4">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-300">1000+ Lowongan Pekerjaan Tersedia</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-300">200+ Perusahaan Mitra</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-300">Pendampingan Karir Gratis</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Stats -->
                <div class="flex-none">
                    <div class="pt-8 border-t border-gray-700">
                        <div class="flex items-center space-x-4">
                            <div class="flex -space-x-2">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=100&h=100&q=80" class="w-10 h-10 rounded-full border-2 border-white object-cover" alt="User">
                                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=100&h=100&q=80" class="w-10 h-10 rounded-full border-2 border-white object-cover" alt="User">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=100&h=100&q=80" class="w-10 h-10 rounded-full border-2 border-white object-cover" alt="User">
                            </div>
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-white">2,000+ Pengguna Aktif</p>
                                <p class="text-sm text-gray-400">Bergabung bersama kami</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section - Auth Form -->
        <div class="flex-1 flex flex-col justify-center lg:w-1/2">
            <div class="sm:mx-auto sm:w-full sm:max-w-md px-6">
                <!-- Mobile Logo -->
                <div class="lg:hidden flex justify-center mb-8">
                    <a href="/" class="inline-block">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="h-8">
                    </a>
                </div>

                <!-- Page Title -->
                <h2 class="text-2xl font-bold text-gray-900 mb-8">
                    @yield('auth-title')
                </h2>

                <!-- Main Content -->
                <main>
                    @yield('content')
                </main>

                <!-- Footer Links -->
                <div class="mt-8 text-center text-sm text-gray-500">
                    @yield('auth-footer')
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('status'))
        <div x-data="{ show: true }"
             x-show="show"
             x-transition
             x-init="setTimeout(() => show = false, 3000)"
             class="fixed bottom-4 right-4 bg-gray-900 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div x-data="{ show: true }"
             x-show="show"
             x-transition
             class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <button @click="show = false" class="float-right ml-4">&times;</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html> 