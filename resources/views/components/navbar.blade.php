<nav class="sticky top-0 z-50 bg-surface-1/95 backdrop-blur-md border-b border-subtle transition-colors duration-300">
    <div class="container mx-auto px-4" x-data="{ mobileOpen: false }">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-brand-cyan to-brand-cyan/80 rounded-lg flex items-center justify-center shadow-lg shadow-brand-cyan/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <div class="text-brand-cyan font-bold text-lg tracking-tight">SANAPATI</div>
                    <div class="text-fg-secondary text-xs hidden md:block font-medium">Sistem Akuntabilitas Kinerja</div>
                </div>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:text-brand-cyan hover:bg-surface-3 {{ request()->routeIs('home') ? 'text-brand-cyan bg-surface-3' : 'text-fg-secondary' }}">
                    Beranda
                </a>
                <a href="{{ route('tree') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:text-brand-cyan hover:bg-surface-3 {{ request()->routeIs('tree') ? 'text-brand-cyan bg-surface-3' : 'text-fg-secondary' }}">
                    Pohon Kinerja
                </a>
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:text-brand-cyan hover:bg-surface-3 {{ request()->routeIs('dashboard') ? 'text-brand-cyan bg-surface-3' : 'text-fg-secondary' }}">
                    Dashboard
                </a>
                <a href="{{ route('help') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:text-brand-cyan hover:bg-surface-3 {{ request()->routeIs('help') ? 'text-brand-cyan bg-surface-3' : 'text-fg-secondary' }}">
                    Bantuan
                </a>

                <!-- Theme Toggle -->
                <button @click="toggleTheme()" class="ml-2 p-2 rounded-lg text-fg-secondary hover:text-brand-cyan hover:bg-surface-3 transition-colors" aria-label="Toggle Theme">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="darkMode" style="display: none;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Menu Button -->
            <button 
                @click="mobileOpen = !mobileOpen"
                class="md:hidden p-2 rounded-lg text-fg-secondary hover:bg-surface-3 transition-colors"
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
            class="md:hidden py-4 space-y-2 border-t border-subtle"
            style="display: none;"
        >
            <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/20 transition">Beranda</a>
            <a href="{{ route('tree') }}" class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/20 transition">Pohon Kinerja</a>
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/20 transition">Dashboard</a>
            <a href="{{ route('help') }}" class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/20 transition">Bantuan</a>
            <!-- Mobile Toggle -->
            <button @click="toggleTheme()" class="w-full text-left px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/20 transition flex items-center gap-2">
                <span x-text="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'">Switch Theme</span>
                <svg x-show="!darkMode" class="w-5 h-5 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg x-show="darkMode" style="display: none;" class="w-5 h-5 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>
        </div>
    </div>
</nav>
