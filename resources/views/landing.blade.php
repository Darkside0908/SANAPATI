@extends('layouts.app')

@section('title', 'SANAPATI - Portal Manajemen Kinerja BSSN')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-brand-cyan/5 via-transparent to-brand-purple/5"></div>
    <div class="container mx-auto px-4 py-20 relative">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block mb-6 animate-fade-in" style="animation-delay: 0.1s">
                <span class="px-4 py-2 rounded-full bg-brand-cyan/10 border border-brand-cyan/20 text-brand-cyan text-sm font-semibold backdrop-blur-sm">
                    Badan Siber dan Sandi Negara
                </span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in" style="animation-delay: 0.2s">
                <span class="bg-gradient-to-r from-brand-cyan to-brand-cyan/70 text-transparent bg-clip-text">SANAPATI</span>
            </h1>
            
            <p class="text-xl md:text-2xl text-fg-primary mb-4 animate-fade-in" style="animation-delay: 0.3s">
                Sistem Akuntabilitas dan Navigasi Kinerja
            </p>
            <p class="text-lg text-fg-secondary mb-10 animate-fade-in" style="animation-delay: 0.4s">
                Siber–Sandi Terintegrasi
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in" style="animation-delay: 0.5s">
                <a href="{{ route('tree') }}" class="px-8 py-4 rounded-lg bg-brand-cyan text-white font-bold text-lg hover:bg-cyan-500 transition shadow-lg shadow-brand-cyan/25 hover:shadow-brand-cyan/40">
                    🌳 Jelajahi Pohon Kinerja
                </a>
                <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-lg border-2 border-brand-cyan/30 text-brand-cyan font-bold text-lg hover:bg-brand-cyan/5 transition">
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
        <div class="p-6 rounded-xl bg-surface-2 border border-subtle hover:border-brand-cyan/30 transition shadow-sm hover:shadow-md group">
            <div class="w-12 h-12 rounded-lg bg-brand-cyan/10 flex items-center justify-center mb-4 group-hover:bg-brand-cyan/20 transition-colors">
                <svg class="w-6 h-6 text-brand-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-fg-primary mb-3">Navigasi Pohon Kinerja</h3>
            <p class="text-fg-secondary">
                Eksplorasi struktur kinerja dari Outcome hingga Indikator dengan navigasi interaktif yang intuitif.
            </p>
        </div>
        
        <!-- Feature 2 -->
        <div class="p-6 rounded-xl bg-surface-2 border border-subtle hover:border-brand-purple/30 transition shadow-sm hover:shadow-md group">
            <div class="w-12 h-12 rounded-lg bg-brand-purple/10 flex items-center justify-center mb-4 group-hover:bg-brand-purple/20 transition-colors">
                <svg class="w-6 h-6 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-fg-primary mb-3">Drill-down Indikator & Target</h3>
            <p class="text-fg-secondary">
                Lihat detail lengkap setiap indikator kinerja beserta target, satuan, dan unit penanggung jawab.
            </p>
        </div>
        
        <!-- Feature 3 -->
        <div class="p-6 rounded-xl bg-surface-2 border border-subtle hover:border-brand-green/30 transition shadow-sm hover:shadow-md group">
            <div class="w-12 h-12 rounded-lg bg-brand-green/10 flex items-center justify-center mb-4 group-hover:bg-brand-green/20 transition-colors">
                <svg class="w-6 h-6 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-fg-primary mb-3">Cascading Kinerja</h3>
            <p class="text-fg-secondary">
                Lihat hubungan parent-child yang jelas dari strategi top-level sampai indikator operasional.
            </p>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="container mx-auto px-4 py-16">
    <div class="max-w-3xl mx-auto text-center p-10 rounded-2xl bg-surface-2 border border-subtle shadow-sm">
        <h2 class="text-3xl font-bold text-fg-primary mb-4">Siap Menjelajah?</h2>
        <p class="text-fg-secondary mb-6">
            Mulai eksplorasi pohon kinerja BSSN untuk memahami struktur dan target kinerja organisasi.
        </p>
        <a href="{{ route('tree') }}" class="inline-block px-8 py-4 rounded-lg bg-brand-cyan text-white font-bold text-lg hover:bg-cyan-500 transition shadow-lg shadow-brand-cyan/25 hover:shadow-brand-cyan/40">
            Mulai Sekarang →
        </a>
    </div>
</div>
@endsection
