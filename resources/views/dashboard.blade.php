@extends('layouts.app')

@section('title', 'Dashboard - SANAPATI')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-cyan-400 mb-8">Dashboard Ringkas</h1>
    
    <!-- Stats Grid -->
    <div class="grid md:grid-cols-4 gap-6 mb-8">
        <div class="p-6 rounded-xl bg-gradient-to-br from-cyan-900/30 to-cyan-900/10 border border-cyan-500/30">
            <div class="flex items-center justify-between mb-3">
                <span class="text-gray-400 text-sm">Total Nodes</span>
                <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">72</p>
            <p class="text-xs text-gray-500 mt-2">Seluruh hierarki</p>
        </div>
        
        <div class="p-6 rounded-xl bg-gradient-to-br from-purple-900/30 to-purple-900/10 border border-purple-500/30">
            <div class="flex items-center justify-between mb-3">
                <span class="text-gray-400 text-sm">Indikator</span>
                <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">36</p>
            <p class="text-xs text-gray-500 mt-2">Level 5</p>
        </div>
        
        <div class="p-6 rounded-xl bg-gradient-to-br from-green-900/30 to-green-900/10 border border-green-500/30">
            <div class="flex items-center justify-between mb-3">
                <span class="text-gray-400 text-sm">Program</span>
                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">10</p>
            <p class="text-xs text-gray-500 mt-2">Level 3</p>
        </div>
        
        <div class="p-6 rounded-xl bg-gradient-to-br from-yellow-900/30 to-yellow-900/10 border border-yellow-500/30">
            <div class="flex items-center justify-between mb-3">
                <span class="text-gray-400 text-sm">Outcome</span>
                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">3</p>
            <p class="text-xs text-gray-500 mt-2">Top level strategis</p>
        </div>
    </div>
    
    <!-- Top Indikator -->
    <div class="bg-[#1a1f35]/50 rounded-xl border border-cyan-500/20 p-6">
        <h2 class="text-xl font-bold text-white mb-6">Top Indikator Prioritas</h2>
        
        <div class="space-y-4">
            <div class="p-4 bg-[#0a0e1a] rounded-lg flex items-center justify-between">
                <div class="flex-1">
                    <span class="badge badge-indikator text-xs mb-2">indikator</span>
                    <p class="text-gray-200 font-semibold">Persentase insiden tertangani sesuai SLA</p>
                    <p class="text-sm text-gray-500 mt-1">Program: Penguatan Operasi Keamanan Siber</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-yellow-400">95%</p>
                    <p class="text-xs text-gray-500">Target 2025</p>
                </div>
            </div>
            
            <div class="p-4 bg-[#0a0e1a] rounded-lg flex items-center justify-between">
                <div class="flex-1">
                    <span class="badge badge-indikator text-xs mb-2">indikator</span>
                    <p class="text-gray-200 font-semibold">Jumlah vulnerability teridentifikasi dan diperbaiki</p>
                    <p class="text-sm text-gray-500 mt-1">Program: Penguatan Operasi Keamanan Siber</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-yellow-400">250</p>
                    <p class="text-xs text-gray-500">Target 2025</p>
                </div>
            </div>
            
            <div class="p-4 bg-[#0a0e1a] rounded-lg flex items-center justify-between">
                <div class="flex-1">
                    <span class="badge badge-indikator text-xs mb-2">indikator</span>
                    <p class="text-gray-200 font-semibold">Waktu rata-rata respons insiden kritis</p>
                    <p class="text-sm text-gray-500 mt-1">Program: Pengembangan SOC Nasional</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-yellow-400">&lt; 2 jam</p>
                    <p class="text-xs text-gray-500">Target 2025</p>
                </div>
            </div>
            
            <div class="p-4 bg-[#0a0e1a] rounded-lg flex items-center justify-between">
                <div class="flex-1">
                    <span class="badge badge-indikator text-xs mb-2">indikator</span>
                    <p class="text-gray-200 font-semibold">Persentase uptime sensor network</p>
                    <p class="text-sm text-gray-500 mt-1">Program: Early Warning System</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-yellow-400">99.5%</p>
                    <p class="text-xs text-gray-500">Target 2025</p>
                </div>
            </div>
        </div>
        
        <div class="mt-6 text-center">
            <a href="{{ route('tree') }}" class="inline-block px-6 py-3 bg-cyan-900/30 border border-cyan-500/30 rounded-lg text-cyan-400 font-semibold hover:bg-cyan-900/50 transition">
                Lihat Selengkapnya di Pohon Kinerja →
            </a>
        </div>
    </div>
</div>
@endsection
