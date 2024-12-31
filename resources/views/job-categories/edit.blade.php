@extends('layouts.dashboard')

@section('title', 'Edit Kategori Pekerjaan')

@section('content')
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <form action="{{ route('job-categories.update', $category) }}" method="POST" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <div class="relative rounded-lg">
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                        class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('name') border-red-300 text-red-900 @enderror"
                        placeholder="Masukkan nama kategori">
                </div>
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-medium text-gray-700">
                    Deskripsi
                </label>
                <div class="relative rounded-lg">
                    <textarea name="description" id="description" rows="4"
                        class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('description') border-red-300 text-red-900 @enderror"
                        placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>
                </div>
                @error('description')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('job-categories.index') }}"
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