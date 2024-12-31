@extends('layouts.dashboard')

@section('title', $jobListing->title)

@section('content')
<div x-data="{ showApplicationModal: false }" class="space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('job-listings.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Lowongan
        </a>
    </div>
    
    <!-- Alert Messages -->
    @if (session('success'))
        <div class="rounded-md bg-green-50 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-md bg-red-50 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">
                        {{ session('error') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Job Details Card -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-8">
            <!-- Header -->
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $jobListing->title }}</h1>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <a href="{{ route('companies.show', $jobListing->company) }}" class="font-medium text-gray-900 hover:text-gray-700">
                            {{ $jobListing->company->name }}
                        </a>
                        <span class="mx-2">•</span>
                        <span>{{ $jobListing->location }}</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Deadline -->
                    <div class="text-sm text-gray-500">
                        <span class="block text-right">Batas Lamaran</span>
                        <span class="font-medium text-gray-900">{{ $jobListing->deadline->format('d M Y') }}</span>
                    </div>
                    <!-- Apply Button for larger screens -->
                    @auth
                        @if(auth()->user()->role === 'jobseeker')
                            @if($hasApplied)
                                <button disabled class="hidden md:inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-gray-100 cursor-not-allowed">
                                    Sudah Dilamar
                                </button>
                            @else
                                <button 
                                    @click="showApplicationModal = true"
                                    class="hidden md:inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                                    Lamar Sekarang
                                </button>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="hidden md:inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                            Login untuk Melamar
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Job Info Grid -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900">Tipe Pekerjaan</h3>
                        <p class="text-sm text-gray-500">{{ $jobListing->employment_type }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900">Level</h3>
                        <p class="text-sm text-gray-500">{{ $jobListing->experience_level }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900">Lokasi</h3>
                        <p class="text-sm text-gray-500">{{ $jobListing->location }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900">Gaji</h3>
                        <p class="text-sm text-gray-500">{{ $jobListing->salary_range }}</p>
                    </div>
                </div>
            </div>

            <!-- Job Description -->
            <div class="mt-8 prose prose-gray max-w-none">
                <h2 class="text-lg font-semibold text-gray-900">Deskripsi Pekerjaan</h2>
                <p class="mt-4 text-gray-600 whitespace-pre-line">{{ $jobListing->description }}</p>

                <h2 class="text-lg font-semibold text-gray-900 mt-8">Persyaratan</h2>
                <div class="mt-4 text-gray-600 whitespace-pre-line">{{ $jobListing->requirements }}</div>

                <h2 class="text-lg font-semibold text-gray-900 mt-8">Benefit</h2>
                <div class="mt-4 text-gray-600 whitespace-pre-line">{{ $jobListing->benefits }}</div>
            </div>
        </div>

        <!-- Sticky Apply Button for mobile -->
        @auth
            @if(auth()->user()->role === 'jobseeker')
                <div class="md:hidden sticky bottom-0 left-0 right-0 p-4 bg-white border-t border-gray-100">
                    @if($hasApplied)
                        <button disabled class="w-full flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-gray-100 cursor-not-allowed">
                            Sudah Dilamar
                        </button>
                    @else
                        <button 
                            @click="showApplicationModal = true"
                            class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                            Lamar Sekarang
                        </button>
                    @endif
                </div>
            @endif
        @else
            <div class="md:hidden sticky bottom-0 left-0 right-0 p-4 bg-white border-t border-gray-100">
                <a href="{{ route('login') }}" class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                    Login untuk Melamar
                </a>
            </div>
        @endauth
    </div>

    <!-- Application Modal -->
    @auth
        @if(auth()->user()->role === 'jobseeker')
            <div x-show="showApplicationModal" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-4"
                class="fixed inset-0 z-[60] overflow-y-auto" 
                aria-labelledby="modal-title" 
                role="dialog" 
                aria-modal="true"
                style="display: none;">
                <div class="flex min-h-screen items-center justify-center p-0">
                    <!-- Background overlay -->
                    <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true"></div>

                    <!-- Modal panel -->
                    <div class="relative w-full max-w-2xl mx-auto my-8 bg-white rounded-xl shadow-xl">
                        <!-- Modal content -->
                        <div class="p-8">
                            <!-- Close button -->
                            <button @click="showApplicationModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 focus:outline-none">
                                <span class="sr-only">Close</span>
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="w-full">
                                <h3 class="text-xl font-bold text-gray-900" id="modal-title">
                                    Lamar Pekerjaan
                                </h3>
                                <p class="mt-2 text-sm text-gray-500">
                                    Lengkapi formulir di bawah untuk melamar posisi {{ $jobListing->title }} di {{ $jobListing->company->name }}.
                                </p>

                                <form action="{{ route('job-applications.store') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
                                    @csrf
                                    <input type="hidden" name="job_listing_id" value="{{ $jobListing->id }}">

                                    <!-- Cover Letter -->
                                    <div class="space-y-2">
                                        <label for="cover_letter" class="block text-sm font-medium text-gray-700">
                                            Cover Letter <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <textarea id="cover_letter" 
                                                name="cover_letter" 
                                                rows="6" 
                                                required
                                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 resize-none"
                                                placeholder="Ceritakan mengapa Anda tertarik dengan posisi ini dan apa yang membuat Anda cocok untuk peran ini."></textarea>
                                        </div>
                                        <p class="text-xs text-gray-500">Minimal 100 karakter</p>
                                    </div>

                                    <!-- Resume -->
                                    <div class="space-y-2">
                                        <label for="resume" class="block text-sm font-medium text-gray-700">
                                            Resume <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="flex items-center justify-center w-full">
                                                <label for="resume" class="flex flex-col items-center w-full p-6 border-2 border-gray-200 border-dashed rounded-lg cursor-pointer hover:border-gray-300 bg-gray-50">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg class="w-10 h-10 text-gray-400 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500">
                                                            <span class="font-medium">Klik untuk upload</span> atau drag and drop
                                                        </p>
                                                        <p class="text-xs text-gray-500">PDF, DOC, atau DOCX (Maks. 2MB)</p>
                                                    </div>
                                                    <input type="file" id="resume" name="resume" required accept=".pdf,.doc,.docx" class="hidden">
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Expected Salary -->
                                    <div class="space-y-2">
                                        <label for="expected_salary" class="block text-sm font-medium text-gray-700">
                                            Ekspektasi Gaji <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="text" 
                                                id="expected_salary" 
                                                name="expected_salary" 
                                                required
                                                class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50"
                                                placeholder="8.000.000">
                                        </div>
                                        <p class="text-xs text-gray-500">Masukkan nominal tanpa titik atau koma</p>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-100">
                                        <button type="button" 
                                            @click="showApplicationModal = false"
                                            class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2.5 text-sm font-medium text-white bg-gray-900 border border-transparent rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                                            Kirim Lamaran
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
</div>
@endsection 