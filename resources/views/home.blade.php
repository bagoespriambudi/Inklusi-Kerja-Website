@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
        <div class="p-6">
            @if (session('status'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stats Card -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium opacity-75">Total Lowongan</p>
                            <p class="text-2xl font-semibold mt-1">24</p>
                        </div>
                        <div class="bg-white/10 rounded-full p-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-400">↑ 12%</span>
                        <span class="opacity-75 ml-2">dari bulan lalu</span>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium opacity-75">Total Pelamar</p>
                            <p class="text-2xl font-semibold mt-1">142</p>
                        </div>
                        <div class="bg-white/10 rounded-full p-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-400">↑ 8%</span>
                        <span class="opacity-75 ml-2">dari bulan lalu</span>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium opacity-75">Perusahaan</p>
                            <p class="text-2xl font-semibold mt-1">38</p>
                        </div>
                        <div class="bg-white/10 rounded-full p-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-400">↑ 4%</span>
                        <span class="opacity-75 ml-2">dari bulan lalu</span>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium opacity-75">Pengguna Premium</p>
                            <p class="text-2xl font-semibold mt-1">64</p>
                        </div>
                        <div class="bg-white/10 rounded-full p-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-400">↑ 22%</span>
                        <span class="opacity-75 ml-2">dari bulan lalu</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900">Aktivitas Terbaru</h3>
                <div class="mt-4 bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <div class="divide-y divide-gray-200">
                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Lamaran Baru</p>
                                        <p class="text-sm text-gray-500">John Doe melamar posisi Frontend Developer</p>
                                    </div>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <span class="text-sm text-gray-500">5 menit yang lalu</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Lowongan Baru</p>
                                        <p class="text-sm text-gray-500">PT Example membuka posisi UI/UX Designer</p>
                                    </div>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <span class="text-sm text-gray-500">1 jam yang lalu</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Pembayaran Premium</p>
                                        <p class="text-sm text-gray-500">Jane Smith berlangganan paket premium</p>
                                    </div>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <span class="text-sm text-gray-500">3 jam yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
