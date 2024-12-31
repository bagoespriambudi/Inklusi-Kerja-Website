<!-- User menu -->
<div class="flex items-center space-x-4">
    @auth
        <!-- Premium Badge -->
        @if(auth()->user()->hasActivePremium)
            <div class="flex items-center">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Premium
                </span>
            </div>
        @endif

        <!-- Profile dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                <div class="flex items-center space-x-4">
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset('images/default-avatar.png') }}" alt="{{ auth()->user()->name }}">
                    <div class="text-sm font-medium text-gray-900">
                        {{ auth()->user()->name }}
                    </div>
                </div>
            </button>

            <!-- Dropdown menu -->
            <div x-show="open" 
                @click.away="open = false"
                class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1"
                role="menu">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                    Profil Saya
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    @endauth
</div> 