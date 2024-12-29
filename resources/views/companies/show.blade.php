@extends('layouts.dashboard')

@section('title', $company->name)

@section('actions')
    @if(auth()->user()->role === 'admin')
        <div class="flex space-x-4">
            <a href="{{ route('companies.edit', $company) }}" 
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition duration-150">
                <svg class="w-5 h-5 mr-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Perusahaan
            </a>
            <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus perusahaan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150">
                    <svg class="w-5 h-5 mr-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus Perusahaan
                </button>
            </form>
        </div>
    @endif
@endsection

@section('content')
    @if(session('success'))
        <div class="p-4 mb-8 text-sm text-green-800 bg-green-50 rounded-lg border border-green-100">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <!-- Company Header -->
        <div class="relative h-64 bg-gradient-to-br from-gray-900 to-gray-800">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8">
                <div class="flex items-end space-x-8">
                    @if($company->logo)
                        <div class="flex-shrink-0">
                            <img class="h-32 w-32 rounded-xl border-4 border-white shadow-xl object-cover" src="{{ $company->logo_url }}" alt="{{ $company->name }}">
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <h2 class="text-4xl font-bold text-white truncate mb-3">{{ $company->name }}</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-100 text-lg font-medium">{{ $company->industry ?? 'Industri tidak disebutkan' }}</span>
                            <span class="text-gray-400">•</span>
                            <span class="text-gray-100 text-lg">{{ $company->location }}</span>
                        </div>
                    </div>
                    @if($company->is_verified)
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-50 text-green-800 border border-green-100 shadow-sm">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Terverifikasi
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Company Details -->
        <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-10">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Tentang Perusahaan</h3>
                    <div class="prose prose-gray max-w-none">
                        {{ $company->description }}
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900">Lowongan Kerja</h3>
                        <span class="px-4 py-2 bg-gray-50 text-gray-700 rounded-lg text-sm font-medium">
                            {{ $company->jobListings->count() }} Lowongan
                        </span>
                    </div>
                    
                    @if($company->jobListings->count() > 0)
                        <div class="space-y-4">
                            @foreach($company->jobListings as $job)
                                <a href="{{ route('jobs.show', $job) }}" class="group block p-6 bg-white border border-gray-100 rounded-xl hover:border-gray-300 hover:shadow-md transition duration-150">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-900 group-hover:text-gray-600 mb-3">{{ $job->title }}</h4>
                                            <div class="space-y-2 text-gray-600">
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>{{ $job->employment_type }} • {{ $job->experience_level }}</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>{{ $job->salary_range }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if($job->deadline)
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $job->deadline->isPast() ? 'bg-red-50 text-red-800 border border-red-100' : 'bg-green-50 text-green-800 border border-green-100' }}">
                                                {{ $job->deadline->isPast() ? 'Ditutup' : 'Buka sampai ' . $job->deadline->format('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-xl border border-gray-100">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-600 font-medium">Belum ada lowongan kerja yang dibuka.</p>
                            <p class="text-gray-500 text-sm mt-1">Periksa kembali beberapa saat lagi.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Contact Information -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Kontak</h3>
                    <dl class="space-y-6">
                        @if($company->website)
                            <div class="flex items-start">
                                <dt class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                </dt>
                                <dd class="ml-3">
                                    <a href="{{ $company->website }}" target="_blank" class="text-gray-900 hover:text-gray-600 transition duration-150">
                                        {{ str($company->website)->replace(['https://', 'http://'], '') }}
                                    </a>
                                </dd>
                            </div>
                        @endif

                        @if($company->email)
                            <div class="flex items-start">
                                <dt class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </dt>
                                <dd class="ml-3">
                                    <a href="mailto:{{ $company->email }}" class="text-gray-900 hover:text-gray-600 transition duration-150">
                                        {{ $company->email }}
                                    </a>
                                </dd>
                            </div>
                        @endif

                        @if($company->phone)
                            <div class="flex items-start">
                                <dt class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </dt>
                                <dd class="ml-3">
                                    <a href="tel:{{ $company->phone }}" class="text-gray-900 hover:text-gray-600 transition duration-150">
                                        {{ $company->phone }}
                                    </a>
                                </dd>
                            </div>
                        @endif

                        @if($company->address)
                            <div class="flex items-start">
                                <dt class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </dt>
                                <dd class="ml-3 text-gray-900">{{ $company->address }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <!-- Statistics -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Statistik</h3>
                    <dl class="grid grid-cols-2 gap-6">
                        <div class="p-4 bg-white rounded-lg border border-gray-100">
                            <dt class="text-sm font-medium text-gray-500 mb-2">Total Lowongan</dt>
                            <dd class="text-3xl font-bold text-gray-900">{{ $company->jobListings->count() }}</dd>
                        </div>
                        <div class="p-4 bg-white rounded-lg border border-gray-100">
                            <dt class="text-sm font-medium text-gray-500 mb-2">Lowongan Aktif</dt>
                            <dd class="text-3xl font-bold text-gray-900">{{ $company->jobListings->where('is_active', true)->count() }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection