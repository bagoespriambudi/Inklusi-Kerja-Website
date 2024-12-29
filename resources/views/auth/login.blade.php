@extends('layouts.auth')

@section('title', 'Login')

@section('auth-title')
    <span class="font-bold text-2xl md:text-3xl text-gray-900">
        Selamat Datang Kembali
        <span class="block mt-1 text-base font-normal text-gray-600">Silakan masuk ke akun Anda</span>
    </span>
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}" class="space-y-8">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email
            </label>
            <div class="relative rounded-lg shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="block w-full pl-10 pr-4 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('email') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="nama@email.com" />
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-gray-700">
                Password
            </label>
            <div class="relative rounded-lg shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="password" type="password" name="password" required
                    class="block w-full pl-10 pr-12 py-3 border border-gray-200 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 sm:text-sm transition-colors @error('password') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="••••••••" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <button type="button" onclick="togglePassword('password')" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-5 w-5" id="show-password" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        <svg class="h-5 w-5" id="hide-password" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                            <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                    </button>
                </div>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember" type="checkbox" name="remember" 
                    class="h-4 w-4 text-gray-900 focus:ring-gray-900 border-gray-300 rounded transition-colors"
                    {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="ml-2 block text-sm text-gray-700">
                    Ingat saya
                </label>
            </div>

            @if (Route::has('password.request'))
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" 
                        class="font-medium text-gray-700 hover:text-gray-900 transition-colors duration-200">
                        Lupa password?
                    </a>
                </div>
            @endif
        </div>

        <!-- Login Button -->
        <div>
            <button type="submit" 
                class="relative w-full inline-flex items-center justify-center px-4 py-3.5 text-sm font-semibold text-white bg-gray-900 rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transform transition-all duration-200">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M14.243 5.757a6 6 0 10-.986 9.284 1 1 0 111.087 1.678A8 8 0 1118 10a3 3 0 01-4.8 2.401A4 4 0 1114 10a1 1 0 102 0c0-1.537-.586-3.07-1.757-4.243zM12 10a2 2 0 10-4 0 2 2 0 004 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                Masuk ke Akun
            </button>
        </div>
    </form>
@endsection

@section('auth-footer')
    <p class="text-sm text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}" 
            class="font-semibold text-gray-900 hover:text-gray-700 transition-colors duration-200">
            Daftar sekarang
        </a>
    </p>
@endsection

@push('scripts')
<script>
    // Add smooth animation for form validation
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('invalid', (e) => {
            e.target.classList.add('shake');
            setTimeout(() => {
                e.target.classList.remove('shake');
            }, 500);
        });
    });

    // Toggle password visibility
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const showIcon = document.getElementById('show-password');
        const hideIcon = document.getElementById('hide-password');
        
        if (input.type === 'password') {
            input.type = 'text';
            showIcon.style.display = 'block';
            hideIcon.style.display = 'none';
        } else {
            input.type = 'password';
            showIcon.style.display = 'none';
            hideIcon.style.display = 'block';
        }
    }
</script>

<style>
    .shake {
        animation: shake 0.5s;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
</style>
@endpush
