@extends('layouts.dashboard')

@section('title', 'Edit Paket Berlangganan')

@section('content')
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <form action="{{ route('subscription-plans.update', $subscriptionPlan) }}" method="POST" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nama Paket <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $subscriptionPlan->name) }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('name') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan nama paket">
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="4" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('description') border-red-300 text-red-900 @enderror"
                            placeholder="Masukkan deskripsi paket">{{ old('description', $subscriptionPlan->description) }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="space-y-2">
                        <label for="price" class="block text-sm font-medium text-gray-700">
                            Harga <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="price" id="price" value="{{ old('price', $subscriptionPlan->price) }}"
                                required
                                class="block w-full pl-12 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('price') border-red-300 text-red-900 @enderror"
                                placeholder="0">
                        </div>
                        @error('price')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div class="space-y-2">
                        <label for="duration_in_days" class="block text-sm font-medium text-gray-700">
                            Durasi (hari) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="duration_in_days" id="duration_in_days"
                            value="{{ old('duration_in_days', $subscriptionPlan->duration_in_days) }}" required
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('duration_in_days') border-red-300 text-red-900 @enderror"
                            placeholder="30">
                        @error('duration_in_days')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Features -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Fitur <span class="text-red-500">*</span>
                        </label>
                        <div id="features-container" class="space-y-4">
                            @foreach (old('features', json_decode($subscriptionPlan->features)) as $index => $feature)
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="features[]" value="{{ $feature }}" required
                                        class="flex-1 px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50 @error('features.' . $index) border-red-300 text-red-900 @enderror"
                                        placeholder="Masukkan fitur">
                                    <button type="button" onclick="removeFeature(this)"
                                        class="text-red-600 hover:text-red-900">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                                @error('features.' . $index)
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            @endforeach
                        </div>
                        <button type="button" onclick="addFeature()"
                            class="mt-2 inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <svg class="w-5 h-5 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Fitur
                        </button>
                        @error('features')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                {{ old('is_active', $subscriptionPlan->is_active) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                            <label for="is_active" class="ml-2 text-sm text-gray-700">
                                Status Aktif
                            </label>
                        </div>
                        @error('is_active')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-8 border-t border-gray-100">
                <a href="{{ route('subscription-plans.index') }}"
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

    @push('scripts')
        <script>
            function addFeature() {
                const container = document.getElementById('features-container');
                const featureInput = document.createElement('div');
                featureInput.className = 'flex items-center space-x-2';
                featureInput.innerHTML = `
                    <input type="text" name="features[]" required
                        class="flex-1 px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50 bg-gray-50"
                        placeholder="Masukkan fitur">
                    <button type="button" onclick="removeFeature(this)"
                        class="text-red-600 hover:text-red-900">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                `;
                container.appendChild(featureInput);
            }

            function removeFeature(button) {
                const container = document.getElementById('features-container');
                if (container.children.length > 1) {
                    button.parentElement.remove();
                }
            }
        </script>
    @endpush
@endsection