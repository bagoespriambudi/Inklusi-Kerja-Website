@extends('layouts.dashboard')

@section('title', 'Tambah Kategori Pekerjaan')

@section('content')
    <div class="bg-white rounded-lg border border-gray-200">
        <form action="{{ route('job-categories.store') }}" method="POST" class="p-8 space-y-8">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <div class="relative rounded-lg shadow-sm">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('name') border-red-300 text-red-900 @enderror"
                        placeholder="Masukkan nama kategori">
                </div>
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-medium text-gray-700">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <div class="relative rounded-lg shadow-sm">
                    <textarea name="description" id="description" rows="4" required
                        class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('description') border-red-300 text-red-900 @enderror"
                        placeholder="Masukkan deskripsi kategori">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('job-categories.index') }}"
                    class="inline-flex justify-center px-4 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex justify-center px-4 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection