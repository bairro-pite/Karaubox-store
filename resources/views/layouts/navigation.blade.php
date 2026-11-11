<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            {{-- Kiri: Logo & Menu --}}
            <div class="flex items-center gap-1">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Karaubox Store" style="height: 66px; width:auto;">
                    </a>
                </div>

                <!-- Menu Link -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                            Home
                    </x-nav-link>
                    <x-nav-link :href="route('ropa.kalsa')" :active="request()->routeIs('ropa.kalsa')">
                        {{ __('Ropa/Kalsa') }}
                    </x-nav-link>
                    <x-nav-link :href="route('ropa.boxing')" :active="request()->routeIs('ropa.boxing')">
                        {{ __('Ropa Boxing') }}
                    </x-nav-link>
                    <x-nav-link :href="route('equipamentu.boxing')" :active="request()->routeIs('equipamentu.boxing')">
                        {{ __('Equipamentu Boxing') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')" class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                        Raga
                    </x-nav-link>
                    <x-nav-link :href="route('checkout')" :active="request()->routeIs('checkout')">
                        {{ __('Checkout') }}
                    </x-nav-link>
                    @if(auth()->id() == 1)
                        @php
                          $jumlahBaru = App\Models\Nota::where('dikonfirmasi', false)->count();
                        @endphp

                <a href="{{ route('admin.notifikasi') }}" class="font-bold flex items-center gap-2">
                        🔔Notif
                    @if($jumlahBaru > 0)
                        <span class="bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                            {{ $jumlahBaru }}
                        </span>
                    @endif
                </a>
    
                <a href="{{ route('admin.notas') }}" class="font-bold">
                    📋Relatório Nota
                </a>
            @endif
                </div>
            </div>

            {{-- TENGAH: KOLOM PENCARIAN 🔍 --}}
            <div class="flex items-center flex-1 max-w-xs mx-4">
                <form action="{{ route('home') }}" method="GET" class="w-full">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Buka produtu..." 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </form>
            </div>

            {{-- Kanan: Utilizador / Login --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    @if(Auth::id() === 1)
                        <x-nav-link :href="route('admin.products.index')" class="me-2">
                            ⚙️Input sasan
                        </x-nav-link>
                    @endif
                    
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Sai') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700">
                                Utilizador ▾
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('login')">
                                {{ __('Login') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')">
                                {{ __('Registrasaun') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            {{-- Menu Mobile --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu Responsive / HP --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('ropa.kalsa')" :active="request()->routeIs('ropa.kalsa')">
                {{ __('Ropa/Kalsa') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('ropa.boxing')" :active="request()->routeIs('ropa.boxing')">
                {{ __('Ropa Boxing') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('equipamentu.boxing')" :active="request()->routeIs('equipamentu.boxing')">
                {{ __('Equipamentu Boxing') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('checkout')" :active="request()->routeIs('checkout')">
                {{ __('Checkout') }}
            </x-responsive-nav-link>
            
            {{-- Pencarian di HP --}}
            <div class="px-4 py-2">
                <form action="{{ route('home') }}" method="GET">
                    <input type="text" name="search" placeholder="Buka produtu..." 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </form>
            </div>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Sai') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Registrasaun') }}
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
