@extends('layouts.dashboard')

@section('title', 'Tambah Pengguna')

@section('content')
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nama <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
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
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('email') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan alamat email">
                        @error('email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" id="password" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('password') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan password">
                        @error('password')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="space-y-2">
                        <label for="role" class="block text-sm font-medium text-gray-700">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select name="role" id="role" required
                            class="block w-full py-2.5 pl-3 pr-10 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('role') border-red-300 text-red-900 @enderror">
                            <option value="">Pilih Role</option>
                            <option value="jobseeker" {{ old('role') === 'jobseeker' ? 'selected' : '' }}>Pencari Kerja</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="space-y-2">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">
                            Nomor Telepon
                        </label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('phone_number') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan nomor telepon">
                        @error('phone_number')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Address -->
                    <div class="space-y-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">
                            Alamat
                        </label>
                        <textarea name="address" id="address" rows="5"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('address') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Avatar -->
                    <div class="space-y-2">
                        <label for="avatar" class="block text-sm font-medium text-gray-700">
                            Foto Profil
                        </label>
                        <input type="file" name="avatar" id="avatar"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
                            accept="image/*">
                        @error('avatar')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500">Upload foto JPG, JPEG, PNG, atau GIF. Maksimal 1MB.</p>
                    </div>

                    <!-- Resume -->
                    <div class="space-y-2">
                        <label for="resume" class="block text-sm font-medium text-gray-700">
                            Resume
                        </label>
                        <input type="file" name="resume" id="resume"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
                            accept=".pdf,.doc,.docx">
                        @error('resume')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500">Upload file PDF, DOC, atau DOCX. Maksimal 2MB.</p>
                    </div>

                    <!-- Premium Status -->
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_premium" id="is_premium" value="1" {{ old('is_premium') ? 'checked' : '' }}
                                class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                            <label for="is_premium" class="ml-2 text-sm text-gray-700">
                                Status Premium
                            </label>
                        </div>
                        @error('is_premium')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Premium Expiry -->
                    <div class="space-y-2">
                        <label for="premium_expires_at" class="block text-sm font-medium text-gray-700">
                            Tanggal Berakhir Premium
                        </label>
                        <input type="date" name="premium_expires_at" id="premium_expires_at" value="{{ old('premium_expires_at') }}"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('premium_expires_at') border-red-300 text-red-900 @enderror">
                        @error('premium_expires_at')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-8 border-t border-gray-100">
                <a href="{{ route('users.index') }}"
                    class="inline-flex justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex justify-center px-4 py-2.5 text-sm font-medium text-white bg-gray-900 border border-transparent rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection