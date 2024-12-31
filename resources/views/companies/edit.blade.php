@extends('layouts.dashboard')

@section('title', 'Edit Perusahaan')

@section('content')
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nama Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-lg">
                        <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('name') border-red-300 text-red-900 @enderror">
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
                    <div class="relative rounded-lg">
                        <input type="text" name="industry" id="industry" value="{{ old('industry', $company->industry) }}"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('industry') border-red-300 text-red-900 @enderror">
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
                    <div class="relative rounded-lg">
                        <input type="text" name="location" id="location" value="{{ old('location', $company->location) }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('location') border-red-300 text-red-900 @enderror">
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
                    <div class="relative rounded-lg">
                        <input type="url" name="website" id="website" value="{{ old('website', $company->website) }}"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('website') border-red-300 text-red-900 @enderror"
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
                    <div class="relative rounded-lg">
                        <input type="email" name="email" id="email" value="{{ old('email', $company->email) }}"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('email') border-red-300 text-red-900 @enderror">
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
                    <div class="relative rounded-lg">
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $company->phone) }}"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('phone') border-red-300 text-red-900 @enderror">
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
                    <div class="flex items-start space-x-4">
                        @if($company->logo)
                            <div class="flex-shrink-0">
                                <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="h-20 w-20 rounded-lg object-cover border border-gray-200">
                            </div>
                        @endif
                        <div class="flex-grow">
                            <input type="file" name="logo" id="logo" accept="image/*"
                                class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('logo') border-red-300 text-red-900 @enderror">
                            <p class="mt-1 text-sm text-gray-500">
                                Format: JPG, PNG. Maksimal 2MB.
                            </p>
                        </div>
                    </div>
                    @error('logo')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Verified -->
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_verified" id="is_verified" value="1" 
                            {{ old('is_verified', $company->is_verified) ? 'checked' : '' }}
                            class="h-4 w-4 text-gray-900 focus:ring-gray-500 border-gray-300 rounded transition-colors">
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
                <div class="relative rounded-lg">
                    <textarea name="description" id="description" rows="4" required
                        class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('description') border-red-300 text-red-900 @enderror">{{ old('description', $company->description) }}</textarea>
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
                <div class="relative rounded-lg">
                    <textarea name="address" id="address" rows="3"
                        class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('address') border-red-300 text-red-900 @enderror">{{ old('address', $company->address) }}</textarea>
                </div>
                @error('address')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('companies.show', $company) }}"
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