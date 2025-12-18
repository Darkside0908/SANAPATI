@extends('layouts.app')

@section('title', 'Bantuan - SANAPATI')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-bold text-fg-primary mb-8">Panduan & FAQ</h1>
    
    <!-- System Overview -->
    <div class="bg-surface-2 rounded-xl border border-subtle p-6 mb-8 shadow-sm">
        <h2 class="text-2xl font-bold text-fg-primary mb-4">Tentang SANAPATI</h2>
        <p class="text-fg-secondary mb-4">
            <strong>SANAPATI</strong> (Sistem Akuntabilitas dan Navigasi Kinerja Siber–Sandi Terintegrasi) adalah portal internal BSSN untuk manajemen kinerja organisasi.
        </p>
        <p class="text-fg-secondary">
            Sistem ini memungkinkan Anda untuk mengeksplorasi struktur kinerja dari level strategis (Outcome) hingga level operasional (Indikator) dengan visualisasi pohon yang interaktif.
        </p>
    </div>
    
    <!-- FAQ -->
    <div class="space-y-4">
        <!-- FAQ 1 -->
        <div class="bg-surface-2 rounded-xl border border-subtle overflow-hidden shadow-sm">
            <details class="group">
                <summary class="p-6 cursor-pointer hover:bg-surface-3 transition flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-fg-primary">Bagaimana cara expand/collapse pohon kinerja?</h3>
                    <svg class="w-5 h-5 text-brand-cyan group-open:rotate-180 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6">
                    <ul class="text-fg-secondary space-y-2 list-disc list-inside">
                        <li>Klik ikon panah (<strong>►</strong>) di sebelah kiri node untuk expand/collapse node tersebut</li>
                        <li>Gunakan tombol <strong>"Expand All"</strong> untuk membuka semua node sekaligus</li>
                        <li>Gunakan tombol <strong>"Collapse All"</strong> untuk menutup semua node</li>
                        <li>Node yang tidak memiliki anak tidak akan menampilkan ikon panah</li>
                    </ul>
                </div>
            </details>
        </div>
        
        <!-- FAQ 2 -->
        <div class="bg-surface-2 rounded-xl border border-subtle overflow-hidden shadow-sm">
            <details class="group">
                <summary class="p-6 cursor-pointer hover:bg-surface-3 transition flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-fg-primary">Bagaimana cara mencari indikator atau program tertentu?</h3>
                    <svg class="w-5 h-5 text-brand-cyan group-open:rotate-180 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6">
                    <ul class="text-fg-secondary space-y-2 list-disc list-inside">
                        <li>Ketik kata kunci di <strong>search bar</strong> di bagian atas pohon kinerja</li>
                        <li>Sistem akan otomatis memfilter node yang sesuai dengan kata kunci</li>
                        <li>Jalur parent dari hasil pencarian akan otomatis ter-expand</li>
                        <li>Klik tombol <strong>"Reset"</strong> untuk menghapus filter dan kembali ke tampilan awal</li>
                        <li>Anda bisa mencari berdasarkan <strong>nama</strong> atau <strong>kode</strong> node</li>
                    </ul>
                </div>
            </details>
        </div>
        
        <!-- FAQ 3 -->
        <div class="bg-surface-2 rounded-xl border border-subtle overflow-hidden shadow-sm">
            <details class="group">
                <summary class="p-6 cursor-pointer hover:bg-surface-3 transition flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-fg-primary">Apa yang dimaksud dengan cascading kinerja?</h3>
                    <svg class="w-5 h-5 text-brand-cyan group-open:rotate-180 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6">
                    <p class="text-fg-secondary mb-3">
                        Cascading kinerja adalah hubungan hierarkis parent-child yang menunjukkan bagaimana strategi organisasi diterjemahkan dari level tertinggi ke level terendah:
                    </p>
                    <div class="space-y-2 ml-4">
                        <div class="flex items-start">
                            <span class="badge badge-outcome mr-3 mt-1">outcome</span>
                            <p class="text-fg-secondary"><strong>Level 1:</strong> Outcome / Sasaran Strategis</p>
                        </div>
                        <div class="ml-8 text-fg-secondary/50">↓</div>
                        <div class="flex items-start">
                            <span class="badge badge-sasaran mr-3 mt-1">sasaran</span>
                            <p class="text-fg-secondary"><strong>Level 2:</strong> Sasaran Strategis</p>
                        </div>
                        <div class="ml-8 text-fg-secondary/50">↓</div>
                        <div class="flex items-start">
                            <span class="badge badge-program mr-3 mt-1">program</span>
                            <p class="text-fg-secondary"><strong>Level 3:</strong> Program</p>
                        </div>
                        <div class="ml-8 text-fg-secondary/50">↓</div>
                        <div class="flex items-start">
                            <span class="badge badge-kegiatan mr-3 mt-1">kegiatan</span>
                            <p class="text-fg-secondary"><strong>Level 4:</strong> Kegiatan</p>
                        </div>
                        <div class="ml-8 text-fg-secondary/50">↓</div>
                        <div class="flex items-start">
                            <span class="badge badge-indikator mr-3 mt-1">indikator</span>
                            <p class="text-fg-secondary"><strong>Level 5:</strong> Indikator (dengan target terukur)</p>
                        </div>
                    </div>
                </div>
            </details>
        </div>
        
        <!-- FAQ 4 -->
        <div class="bg-surface-2 rounded-xl border border-subtle overflow-hidden shadow-sm">
            <details class="group">
                <summary class="p-6 cursor-pointer hover:bg-surface-3 transition flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-fg-primary">Bagaimana cara melihat detail indikator dan targetnya?</h3>
                    <svg class="w-5 h-5 text-brand-cyan group-open:rotate-180 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6">
                    <ul class="text-fg-secondary space-y-2 list-disc list-inside">
                        <li>Klik pada node di pohon kinerja</li>
                        <li>Panel detail akan muncul di sebelah kanan (desktop) atau di bawah (mobile)</li>
                        <li>Untuk indikator, Anda akan melihat:
                            <ul class="ml-8 mt-2 space-y-1 list-circle">
                                <li>Nama indikator</li>
                                <li>Target (angka yang harus dicapai)</li>
                                <li>Satuan pengukuran</li>
                                <li>Tahun target</li>
                                <li>Unit penanggung jawab</li>
                            </ul>
                        </li>
                        <li>Panel detail juga menampilkan breadcrumb untuk melihat jalur hierarki node tersebut</li>
                    </ul>
                </div>
            </details>
        </div>
        
        <!-- FAQ 5 -->
        <div class="bg-surface-2 rounded-xl border border-subtle overflow-hidden shadow-sm">
            <details class="group">
                <summary class="p-6 cursor-pointer hover:bg-surface-3 transition flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-fg-primary">Bagaimana cara update data pohon kinerja?</h3>
                    <svg class="w-5 h-5 text-brand-cyan group-open:rotate-180 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6">
                    <p class="text-fg-secondary mb-3">
                        Data pohon kinerja bisa di-update dengan dua cara:
                    </p>
                    <ol class="text-fg-secondary space-y-2 list-decimal list-inside">
                        <li>
                            <strong>Melalui Python Script:</strong>
                            <pre class="bg-surface-3 p-3 rounded mt-2 text-sm overflow-x-auto text-fg-primary"><code>python python/generate_tree_dummy.py</code></pre>
                        </li>
                        <li class="mt-3">
                            <strong>Melalui Artisan Command:</strong>
                            <pre class="bg-surface-3 p-3 rounded mt-2 text-sm overflow-x-auto text-fg-primary"><code>php artisan tree:generate</code></pre>
                        </li>
                        <li class="mt-3">
                            <strong>Edit manual JSON:</strong>
                            <p class="text-sm text-fg-secondary mt-1">Edit file <code class="bg-surface-3 px-2 py-1 rounded">storage/app/tree/tree.json</code></p>
                        </li>
                    </ol>
                </div>
            </details>
        </div>
    </div>
    
    <!-- Need Help -->
    <div class="mt-8 p-6 bg-gradient-to-r from-brand-cyan/10 to-brand-purple/10 border border-brand-cyan/20 rounded-xl text-center">
        <h3 class="text-xl font-bold text-fg-primary mb-3">Butuh Bantuan Lebih Lanjut?</h3>
        <p class="text-fg-secondary mb-4">Hubungi tim IT BSSN atau buka ticket support</p>
        <a href="mailto:support@bssn.go.id" class="inline-block px-6 py-3 bg-brand-cyan/10 border border-brand-cyan/30 rounded-lg text-brand-cyan font-semibold hover:bg-brand-cyan/20 transition">
            📧 Hubungi Support
        </a>
    </div>
</div>
@endsection
