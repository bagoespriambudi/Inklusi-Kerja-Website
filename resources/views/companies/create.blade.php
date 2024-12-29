@extends('layouts.dashboard')

@section('title', 'Tambah Perusahaan')

@section('content')
    <div class="bg-white rounded-lg border border-gray-200">
        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nama Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-lg shadow-sm">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('name') border-red-300 text-red-900 @enderror">
                    </div>
                    @error('name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Industry -->
                <div class="space-y-2">
                    <label for="industry" class="block text-sm font-medium text-gray-700">
                        Industri
                    </label>
                    <div class="relative rounded-lg shadow-sm">
                        <input type="text" name="industry" id="industry" value="{{ old('industry') }}"
                            class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('industry') border-red-300 text-red-900 @enderror">
                    </div>
                    @error('industry')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div class="space-y-2">
                    <label for="location" class="block text-sm font-medium text-gray-700">
                        Lokasi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-lg shadow-sm">
                        <input type="text" name="location" id="location" value="{{ old('location') }}" required
                            class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('location') border-red-300 text-red-900 @enderror">
                    </div>
                    @error('location')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Website -->
                <div class="space-y-2">
                    <label for="website" class="block text-sm font-medium text-gray-700">
                        Website
                    </label>
                    <div class="relative rounded-lg shadow-sm">
                        <input type="url" name="website" id="website" value="{{ old('website') }}"
                            class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('website') border-red-300 text-red-900 @enderror"
                            placeholder="https://">
                    </div>
                    @error('website')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <div class="relative rounded-lg shadow-sm">
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('email') border-red-300 text-red-900 @enderror">
                    </div>
                    @error('email')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="space-y-2">
                    <label for="phone" class="block text-sm font-medium text-gray-700">
                        Nomor Telepon
                    </label>
                    <div class="relative rounded-lg shadow-sm">
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                            class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('phone') border-red-300 text-red-900 @enderror">
                    </div>
                    @error('phone')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo -->
                <div class="space-y-2">
                    <label for="logo" class="block text-sm font-medium text-gray-700">
                        Logo
                    </label>
                    <div class="relative rounded-lg shadow-sm">
                        <input type="file" name="logo" id="logo" accept="image/*"
                            class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('logo') border-red-300 text-red-900 @enderror">
                    </div>
                    <p class="text-sm text-gray-500">
                        Format: JPG, PNG. Maksimal 2MB.
                    </p>
                    @error('logo')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Verified -->
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_verified" id="is_verified" value="1" {{ old('is_verified') ? 'checked' : '' }}
                            class="h-4 w-4 text-gray-900 focus:ring-gray-900 border-gray-300 rounded transition-colors">
                        <label for="is_verified" class="ml-2 block text-sm text-gray-700">
                            Verifikasi Perusahaan
                        </label>
                    </div>
                    @error('is_verified')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-medium text-gray-700">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <div class="relative rounded-lg shadow-sm">
                    <textarea name="description" id="description" rows="4" required
                        class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('description') border-red-300 text-red-900 @enderror">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="space-y-2">
                <label for="address" class="block text-sm font-medium text-gray-700">
                    Alamat Lengkap
                </label>
                <div class="relative rounded-lg shadow-sm">
                    <textarea name="address" id="address" rows="3"
                        class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('address') border-red-300 text-red-900 @enderror">{{ old('address') }}</textarea>
                </div>
                @error('address')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('companies.index') }}"
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