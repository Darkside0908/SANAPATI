@extends('layouts.app')

@section('title', 'SANAPATI - Portal Manajemen Kinerja BSSN')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-cyan-900/20 via-transparent to-purple-900/20"></div>
    <div class="container mx-auto px-4 py-20 relative">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block mb-6">
                <span class="px-4 py-2 rounded-full bg-cyan-900/30 border border-cyan-400/30 text-cyan-400 text-sm font-semibold">
                    Badan Siber dan Sandi Negara
                </span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                <span class="bg-gradient-to-r from-cyan-400 to-cyan-600 text-transparent bg-clip-text">SANAPATI</span>
            </h1>
            
            <p class="text-xl md:text-2xl text-gray-300 mb-4">
                Sistem Akuntabilitas dan Navigasi Kinerja
            </p>
            <p class="text-lg text-gray-400 mb-10">
                Siber–Sandi Terintegrasi
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('tree') }}" class="px-8 py-4 rounded-lg bg-gradient-to-r from-cyan-500 to-cyan-600 text-gray-900 font-bold text-lg hover:from-cyan-400 hover:to-cyan-500 transition glow-cyan">
                    🌳 Jelajahi Pohon Kinerja
                </a>
                <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-lg border-2 border-cyan-500/50 text-cyan-400 font-bold text-lg hover:bg-cyan-900/20 transition">
                    📊 Lihat Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container mx-auto px-4 py-16">
    <div class="grid md:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="p-6 rounded-xl bg-gradient-to-br from-cyan-900/20 to-cyan-900/5 border border-cyan-500/20 hover:border-cyan-500/40 transition">
            <div class="w-12 h-12 rounded-lg bg-cyan-500/20 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-cyan-400 mb-3">Navigasi Pohon Kinerja</h3>
            <p class="text-gray-400">
                Eksplorasi struktur kinerja dari Outcome hingga Indikator dengan navigasi interaktif yang intuitif.
            </p>
        </div>
        
        <!-- Feature 2 -->
        <div class="p-6 rounded-xl bg-gradient-to-br from-purple-900/20 to-purple-900/5 border border-purple-500/20 hover:border-purple-500/40 transition">
            <div class="w-12 h-12 rounded-lg bg-purple-500/20 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-purple-400 mb-3">Drill-down Indikator & Target</h3>
            <p class="text-gray-400">
                Lihat detail lengkap setiap indikator kinerja beserta target, satuan, dan unit penanggung jawab.
            </p>
        </div>
        
        <!-- Feature 3 -->
        <div class="p-6 rounded-xl bg-gradient-to-br from-green-900/20 to-green-900/5 border border-green-500/20 hover:border-green-500/40 transition">
            <div class="w-12 h-12 rounded-lg bg-green-500/20 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-green-400 mb-3">Cascading Kinerja</h3>
            <p class="text-gray-400">
                Lihat hubungan parent-child yang jelas dari strategi top-level sampai indikator operasional.
            </p>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="container mx-auto px-4 py-16">
    <div class="max-w-3xl mx-auto text-center p-10 rounded-2xl bg-gradient-to-r from-cyan-900/30 to-purple-900/30 border border-cyan-500/30">
        <h2 class="text-3xl font-bold text-white mb-4">Siap Menjelajah?</h2>
        <p class="text-gray-300 mb-6">
            Mulai eksplorasi pohon kinerja BSSN untuk memahami struktur dan target kinerja organisasi.
        </p>
        <a href="{{ route('tree') }}" class="inline-block px-8 py-4 rounded-lg bg-gradient-to-r from-cyan-500 to-cyan-600 text-gray-900 font-bold text-lg hover:from-cyan-400 hover:to-cyan-500 transition glow-cyan">
            Mulai Sekarang →
        </a>
    </div>
</div>
@endsection
