@extends('layouts.dashboard')

@section('title', 'Edit Lowongan Pekerjaan')

@section('content')
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <form action="{{ route('job-listings.update', $jobListing) }}" method="POST" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Company -->
                    <div class="space-y-2">
                        <label for="company_id" class="block text-sm font-medium text-gray-700">
                            Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <select name="company_id" id="company_id" required
                            class="block w-full py-2.5 pl-3 pr-10 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('company_id') border-red-300 text-red-900 @enderror">
                            <option value="">Pilih Perusahaan</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $jobListing->company_id) == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="space-y-2">
                        <label for="job_category_id" class="block text-sm font-medium text-gray-700">
                            Kategori Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <select name="job_category_id" id="job_category_id" required
                            class="block w-full py-2.5 pl-3 pr-10 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('job_category_id') border-red-300 text-red-900 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('job_category_id', $jobListing->job_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('job_category_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            Judul Lowongan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $jobListing->title) }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('title') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan judul lowongan">
                        @error('title')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Employment Type -->
                    <div class="space-y-2">
                        <label for="employment_type" class="block text-sm font-medium text-gray-700">
                            Tipe Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <select name="employment_type" id="employment_type" required
                            class="block w-full py-2.5 pl-3 pr-10 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('employment_type') border-red-300 text-red-900 @enderror">
                            <option value="">Pilih Tipe</option>
                            <option value="full-time" {{ old('employment_type', $jobListing->employment_type) === 'full-time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time" {{ old('employment_type', $jobListing->employment_type) === 'part-time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ old('employment_type', $jobListing->employment_type) === 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="internship" {{ old('employment_type', $jobListing->employment_type) === 'internship' ? 'selected' : '' }}>Internship</option>
                            <option value="freelance" {{ old('employment_type', $jobListing->employment_type) === 'freelance' ? 'selected' : '' }}>Freelance</option>
                        </select>
                        @error('employment_type')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Experience Level -->
                    <div class="space-y-2">
                        <label for="experience_level" class="block text-sm font-medium text-gray-700">
                            Level Pengalaman <span class="text-red-500">*</span>
                        </label>
                        <select name="experience_level" id="experience_level" required
                            class="block w-full py-2.5 pl-3 pr-10 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('experience_level') border-red-300 text-red-900 @enderror">
                            <option value="">Pilih Level</option>
                            <option value="entry" {{ old('experience_level', $jobListing->experience_level) === 'entry' ? 'selected' : '' }}>Entry Level</option>
                            <option value="mid" {{ old('experience_level', $jobListing->experience_level) === 'mid' ? 'selected' : '' }}>Mid Level</option>
                            <option value="senior" {{ old('experience_level', $jobListing->experience_level) === 'senior' ? 'selected' : '' }}>Senior Level</option>
                        </select>
                        @error('experience_level')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="space-y-2">
                        <label for="location" class="block text-sm font-medium text-gray-700">
                            Lokasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="location" id="location" value="{{ old('location', $jobListing->location) }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('location') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan lokasi pekerjaan">
                        @error('location')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Salary Range -->
                    <div class="space-y-2">
                        <label for="salary_range" class="block text-sm font-medium text-gray-700">
                            Kisaran Gaji <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="salary_range" id="salary_range" value="{{ old('salary_range', $jobListing->salary_range) }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('salary_range') border-red-300 text-red-900 @enderror"
                            placeholder="Contoh: Rp 5.000.000 - Rp 8.000.000">
                        @error('salary_range')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Description -->
                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Deskripsi Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="5" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('description') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan deskripsi pekerjaan">{{ old('description', $jobListing->description) }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Requirements -->
                    <div class="space-y-2">
                        <label for="requirements" class="block text-sm font-medium text-gray-700">
                            Persyaratan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="requirements" id="requirements" rows="5" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('requirements') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan persyaratan pekerjaan">{{ old('requirements', $jobListing->requirements) }}</textarea>
                        @error('requirements')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Benefits -->
                    <div class="space-y-2">
                        <label for="benefits" class="block text-sm font-medium text-gray-700">
                            Benefit <span class="text-red-500">*</span>
                        </label>
                        <textarea name="benefits" id="benefits" rows="5" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('benefits') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan benefit pekerjaan">{{ old('benefits', $jobListing->benefits) }}</textarea>
                        @error('benefits')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deadline -->
                    <div class="space-y-2">
                        <label for="deadline" class="block text-sm font-medium text-gray-700">
                            Batas Akhir Lamaran <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $jobListing->deadline->format('Y-m-d')) }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('deadline') border-red-300 text-red-900 @enderror">
                        @error('deadline')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label for="is_active" class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $jobListing->is_active) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                            <span class="ml-2 text-sm text-gray-700">Aktifkan Lowongan</span>
                        </label>
                        @error('is_active')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-8 border-t border-gray-100">
                <a href="{{ route('job-listings.index') }}"
                    class="inline-flex justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex justify-center px-4 py-2.5 text-sm font-medium text-white bg-gray-900 border border-transparent rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection 