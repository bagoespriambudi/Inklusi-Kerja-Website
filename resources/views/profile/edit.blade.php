@extends('layouts.dashboard')

@section('title', 'Edit Profil')

@section('content')
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 bg-green-50 rounded-lg border border-green-100">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Avatar -->
            <div class="flex items-center space-x-8">
                <div class="flex-shrink-0">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" 
                            class="w-24 h-24 rounded-full object-cover border-2 border-gray-200">
                    @else
                        <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="space-y-2">
                    <label for="avatar" class="block text-sm font-medium text-gray-700">
                        Foto Profil
                    </label>
                    <input type="file" name="avatar" id="avatar"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 @error('avatar') border-red-300 text-red-900 @enderror"
                        accept="image/*">
                    @error('avatar')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500">Upload foto JPG, JPEG, PNG, atau GIF. Maksimal 1MB.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nama <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('name') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan nama lengkap">
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('email') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan alamat email">
                        @error('email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="space-y-2">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">
                            Nomor Telepon
                        </label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('phone_number') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan nomor telepon">
                        @error('phone_number')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="space-y-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">
                            Alamat
                        </label>
                        <textarea name="address" id="address" rows="3"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('address') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Resume -->
                    <div class="space-y-2">
                        <label for="resume" class="block text-sm font-medium text-gray-700">
                            Resume
                        </label>
                        <input type="file" name="resume" id="resume"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 @error('resume') border-red-300 text-red-900 @enderror"
                            accept=".pdf,.doc,.docx">
                        @error('resume')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @if($user->resume_path)
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <svg class="w-5 h-5 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <a href="{{ asset('storage/' . $user->resume_path) }}" target="_blank" class="hover:text-gray-900">
                                    Lihat resume saat ini
                                </a>
                            </div>
                        @endif
                        <p class="mt-1 text-sm text-gray-500">Upload file PDF, DOC, atau DOCX. Maksimal 2MB.</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-8 border-t border-gray-100">
                <a href="{{ route('dashboard') }}"
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