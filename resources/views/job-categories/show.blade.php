@extends('layouts.dashboard')

@section('title', $category->name)

@section('content')
    <!-- Header -->
    <div class="mb-8 bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
                    <p class="text-gray-600">{{ $category->description }}</p>
                </div>
                @if(auth()->user()->role === 'admin')
                    <div class="flex space-x-3">
                        <a href="{{ route('job-categories.edit', $category) }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('job-categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-700 bg-white border border-red-300 rounded-lg hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Job Listings -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-900">Daftar Lowongan</h2>
                <span class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium bg-gray-50 text-gray-800 border border-gray-100">
                    {{ $category->jobListings->count() }} Lowongan
                </span>
            </div>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse($category->jobListings as $job)
                <div class="p-6 hover:bg-gray-50 transition duration-150">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-base font-medium text-gray-900 mb-1">
                                <a href="{{ route('job-listings.show', $job) }}" class="hover:text-gray-600">
                                    {{ $job->title }}
                                </a>
                            </h3>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $job->employment_type }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $job->location }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($job->is_active)
                                <span class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium bg-green-50 text-green-800 border border-green-100">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium bg-red-50 text-red-800 border border-red-100">
                                    Tidak Aktif
                                </span>
                            @endif
                            <a href="{{ route('job-listings.show', $job) }}"
                                class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-500 mb-1">Belum ada lowongan dalam kategori ini</p>
                    <p class="text-gray-400 text-sm">Lowongan yang ditambahkan dalam kategori ini akan muncul di sini</p>
                </div>
            @endforelse
        </div>

        @if($category->jobListings->count() > 0)
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">
                        Menampilkan {{ $category->jobListings->count() }} lowongan
                    </span>
                </div>
            </div>
        @endif
    </div>
@endsection 