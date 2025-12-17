<nav class="sticky top-0 z-50 bg-[#0a0e1a]/95 backdrop-blur-md border-b border-cyan-900/30">
    <div class="container mx-auto px-4" x-data="{ mobileOpen: false }">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-cyan-400 font-bold text-lg">SANAPATI</div>
                    <div class="text-gray-500 text-xs hidden md:block">BSSN</div>
                </div>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-gray-300 hover:text-cyan-400 hover:bg-cyan-900/20 transition {{ request()->routeIs('home') ? 'text-cyan-400 bg-cyan-900/20' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('tree') }}" class="px-4 py-2 rounded-lg text-gray-300 hover:text-cyan-400 hover:bg-cyan-900/20 transition {{ request()->routeIs('tree') ? 'text-cyan-400 bg-cyan-900/20' : '' }}">
                    Pohon Kinerja
                </a>
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-gray-300 hover:text-cyan-400 hover:bg-cyan-900/20 transition {{ request()->routeIs('dashboard') ? 'text-cyan-400 bg-cyan-900/20' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('help') }}" class="px-4 py-2 rounded-lg text-gray-300 hover:text-cyan-400 hover:bg-cyan-900/20 transition {{ request()->routeIs('help') ? 'text-cyan-400 bg-cyan-900/20' : '' }}">
                    Bantuan
                </a>
                <a href="{{ route('login') }}" class="ml-4 px-6 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-cyan-600 text-gray-900 font-semibold hover:from-cyan-400 hover:to-cyan-500 transition">
                    Masuk
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <button 
                @click="mobileOpen = !mobileOpen"
                class="md:hidden p-2 rounded-lg text-gray-300 hover:bg-cyan-900/20"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div 
            x-show="mobileOpen" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="md:hidden py-4 space-y-2"
            style="display: none;"
        >
            <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-gray-300 hover:text-cyan-400 hover:bg-cyan-900/20 transition">Beranda</a>
            <a href="{{ route('tree') }}" class="block px-4 py-2 rounded-lg text-gray-300 hover:text-cyan-400 hover:bg-cyan-900/20 transition">Pohon Kinerja</a>
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-300 hover:text-cyan-400 hover:bg-cyan-900/20 transition">Dashboard</a>
            <a href="{{ route('help') }}" class="block px-4 py-2 rounded-lg text-gray-300 hover:text-cyan-400 hover:bg-cyan-900/20 transition">Bantuan</a>
            <a href="{{ route('login') }}" class="block px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-cyan-600 text-gray-900 font-semibold text-center">Masuk</a>
        </div>
    </div>
</nav>
