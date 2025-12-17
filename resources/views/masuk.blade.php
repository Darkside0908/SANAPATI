@extends('layouts.app')

@section('title', 'Masuk - SANAPATI')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-md mx-auto">
        <div class="bg-[#1a1f35]/50 rounded-xl border border-cyan-500/20 p-8">
            <!-- Logo/Title -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Masuk ke SANAPATI</h1>
                <p class="text-gray-400">Portal Manajemen Kinerja BSSN</p>
            </div>
            
            <!-- Login Form (Placeholder) -->
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Username / Email</label>
                    <input 
                        type="text" 
                        placeholder="username@bssn.go.id"
                        class="w-full px-4 py-3 bg-[#0a0e1a] border border-cyan-500/30 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-cyan-500 transition"
                        disabled
                    >
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Password</label>
                    <input 
                        type="password" 
                        placeholder="••••••••"
                        class="w-full px-4 py-3 bg-[#0a0e1a] border border-cyan-500/30 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-cyan-500 transition"
                        disabled
                    >
                </div>
                
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-400">
                        <input type="checkbox" class="mr-2 rounded" disabled>
                        Ingat saya
                    </label>
                    <a href="#" class="text-sm text-cyan-400 hover:text-cyan-300" onclick="return false;">Lupa password?</a>
                </div>
                
                <button 
                    type="button"
                    class="w-full py-3 bg-gradient-to-r from-cyan-500 to-cyan-600 text-gray-900 font-bold rounded-lg opacity-50 cursor-not-allowed"
                    disabled
                >
                    🔒 Masuk (Disabled)
                </button>
            </form>
            
            <!-- Notice -->
            <div class="mt-6 p-4 bg-yellow-900/20 border border-yellow-500/30 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-400 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-yellow-400 mb-1">Placeholder UI</p>
                        <p class="text-xs text-gray-400">
                            Halaman login ini adalah placeholder. Autentikasi belum diimplementasikan. 
                            Untuk menambahkan fitur login, gunakan Laravel Breeze atau Jetstream.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-cyan-400 hover:text-cyan-300 transition">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
        
        <!-- Additional Info -->
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} BSSN - Badan Siber dan Sandi Negara</p>
        </div>
    </div>
</div>
@endsection
