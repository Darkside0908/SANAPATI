@extends('layouts.app')

@section('title', 'Pohon Kinerja BSSN 2025-2029')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="treeApp()">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-6">
        <div class="inline-flex flex-col px-12 py-8 rounded-[24px] border border-subtle shadow-lg relative overflow-hidden backdrop-blur-md bg-surface-2/80 transition-colors duration-300">
             <!-- Brand accent -->
             <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-brand-cyan/50 to-transparent"></div>
             
             <h1 class="text-4xl md:text-5xl font-[800] text-transparent bg-clip-text bg-gradient-to-r from-brand-cyan to-brand-cyan/70 tracking-wide">
                Pohon Kinerja BSSN
            </h1>
            <span class="text-xl font-medium text-fg-secondary block mt-2 tracking-[0.2em] uppercase">
                2025 – 2029
            </span>
        </div>
        
        <!-- Search & Filter -->
        <div class="flex flex-wrap gap-4 items-center">
            <div class="relative">
                <input 
                    type="text" 
                    x-model="searchQuery" 
                    @input.debounce.300ms="performSearch()"
                    placeholder="Cari sasaran / indikator..." 
                    class="bg-surface-1 border border-subtle rounded-lg px-4 py-2 text-fg-primary w-64 focus:outline-none focus:border-brand-cyan focus:ring-1 focus:ring-brand-cyan shadow-sm transition-colors"
                >
            </div>
            
            <!-- Unit Filter -->
            <select x-model="selectedUnit" @change="applyFilters()" class="bg-surface-1 border border-subtle rounded-lg px-4 py-2 text-fg-primary focus:outline-none focus:border-brand-cyan shadow-sm transition-colors">
                <option value="">Semua Unit</option>
                <template x-for="unit in availableUnits" :key="unit">
                    <option :value="unit" x-text="unit"></option>
                </template>
            </select>

            <!-- Toggle Codes -->
            <label class="flex items-center space-x-2 text-sm text-fg-secondary cursor-pointer select-none hover:text-fg-primary transition-colors">
                <input type="checkbox" x-model="showCodes" @change="rerenderTree()" class="form-checkbox text-brand-cyan rounded bg-surface-1 border-subtle">
                <span>Tampilkan Kode</span>
            </label>
        </div>
    </div>

    <!-- Tree View Card - Full Width -->
    <div class="flex flex-col min-h-[600px] max-h-[85vh]">
        <div class="bg-surface-2/90 backdrop-blur-md border border-subtle rounded-2xl shadow-xl flex flex-col h-full overflow-hidden relative group transition-colors duration-300">
            <!-- Glowing Border Effect -->
            <div class="absolute inset-0 border border-subtle rounded-2xl pointer-events-none z-20"></div>
            
            <!-- Toolbar -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-subtle bg-surface-1/50">
                <h3 class="font-semibold text-lg text-fg-primary tracking-wide flex items-center gap-2">
                    <svg class="w-5 h-5 text-brand-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Struktur Kinerja
                </h3>
                <div class="flex gap-2">
                    <button @click="expandAll()" class="px-3 py-1.5 text-xs font-medium text-brand-cyan hover:bg-brand-cyan/10 rounded transition-colors uppercase tracking-wider">
                        Expand All
                    </button>
                     <button @click="collapseAll()" class="px-3 py-1.5 text-xs font-medium text-fg-secondary hover:text-fg-primary hover:bg-surface-3 rounded transition-colors uppercase tracking-wider">
                        Collapse
                    </button>
                </div>
            </div>

            <!-- Scrollable Tree Area -->
            <div class="flex-1 overflow-y-auto overflow-x-auto p-6 custom-scrollbar">
                <div x-show="loading" class="flex flex-col items-center justify-center h-40 space-y-4 animate-pulse">
                    <div class="w-8 h-8 border-2 border-brand-cyan border-t-transparent rounded-full animate-spin"></div>
                    <span class="text-fg-secondary text-sm font-mono">Memuat data pohon...</span>
                </div>
                
                <div x-show="!loading">
                    <ul id="treeRoot" class="space-y-1">
                        <!-- Tree Content -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail Modal -->
    <div 
        x-show="showModal" 
        style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div 
            class="bg-surface-1 border border-subtle rounded-2xl w-full max-w-5xl max-h-[90vh] overflow-y-auto shadow-2xl p-8 relative"
            @click.away="closeModal()"
        >
            <button @click="closeModal()" class="absolute top-4 right-4 text-fg-secondary hover:text-fg-primary bg-surface-3 hover:bg-surface-2 p-2 rounded-full transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <template x-if="selectedNode">
                <div class="animate-fade-in">
                        <div class="border-b border-subtle pb-6 mb-6">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider border"
                                    :class="getLevelBadgeColor(selectedNode.level_type)">
                                <span x-text="selectedNode.level_type"></span>
                            </span>
                            <span class="text-sm font-mono text-fg-secondary" x-text="selectedNode.code"></span>
                        </div>
                        <h2 class="text-2xl font-bold text-fg-primary mt-2 leading-tight" x-text="selectedNode.title"></h2>
                    </div>

                    <!-- Description / Note -->
                    <div x-show="selectedNode.note" class="mb-8 bg-blue-50 dark:bg-blue-900/10 p-5 rounded-xl border border-blue-100 dark:border-blue-500/10">
                        <h3 class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-2 flex items-center gap-2">
                             <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Deskripsi
                        </h3>
                        <p class="text-blue-800 dark:text-blue-100/80 text-sm leading-relaxed" x-text="selectedNode.note"></p>
                    </div>

                    <!-- Indikator Kinerja -->
                    <div x-show="selectedNode.indicators && selectedNode.indicators.length > 0" class="mb-8">
                        <h3 class="text-sm font-bold text-fg-primary mb-4 border-l-4 border-brand-cyan pl-3">Indikator Kinerja</h3>
                        <div class="grid gap-3">
                            <template x-for="indicator in selectedNode.indicators" :key="indicator.code || indicator.name">
                                <div class="bg-surface-2 p-4 rounded-xl border border-subtle hover:border-brand-cyan/30 transition-all">
                                    <h4 class="text-base font-semibold text-fg-primary mb-4" x-text="indicator.name"></h4>
                                    
                                    <!-- Target Box for Each Indicator -->
                                    <div class="bg-gradient-to-r from-orange-500/10 to-red-500/10 border border-orange-500/30 rounded-lg p-3">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                                <span class="text-xs font-bold text-orange-500 uppercase tracking-wider">Target</span>
                                            </div>
                                            <span class="text-xs font-mono text-fg-secondary" x-text="indicator.satuan || '-'"></span>
                                        </div>
                                        <div class="text-sm font-mono">
                                            <span class="text-fg-primary" x-text="indicator.target || 'Data akan diisi nanti'"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                        <!-- Unit Penanggung Jawab -->
                    <div>
                        <h3 class="text-sm font-bold text-fg-primary mb-4 border-l-4 border-brand-cyan pl-3">Penanggung Jawab</h3>
                        <div class="grid gap-3">
                            <template x-if="selectedNode.units && selectedNode.units.length > 0">
                                <template x-for="unit in selectedNode.units">
                                    <div class="bg-surface-2 p-4 rounded-xl border border-subtle hover:border-brand-cyan/30 transition-all">
                                        <span class="px-3 py-1 bg-surface-3 text-fg-primary rounded text-sm border border-subtle font-mono" x-text="unit.code"></span>
                                    </div>
                                </template>
                            </template>
                            
                            <template x-if="!selectedNode.units || selectedNode.units.length === 0">
                                <p class="text-sm text-fg-secondary italic">Belum ada data unit penanggung jawab.</p>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function treeApp() {
        return {
            loading: true,
            treeData: [],
            availableUnits: [],
            selectedNode: null,
            showModal: false,
            searchQuery: '',
            selectedUnit: '',
            showCodes: true,
            expandedNodes: new Set(),
            
            async init() {
                try {
                    const response = await fetch('/api/pohon-kinerja');
                    this.treeData = await response.json();
                    this.extractUnits(this.treeData);
                    
                    // Auto-expand Root
                    if(this.treeData.length > 0) this.expandedNodes.add(this.treeData[0].code);
                    
                    this.renderTree(this.treeData, document.getElementById('treeRoot'));
                } catch (e) {
                    console.error('Error fetching tree:', e);
                } finally {
                    this.loading = false;
                }
            },

            extractUnits(nodes) {
                const units = new Set();
                const traverse = (list) => {
                    list.forEach(node => {
                        if (node.units) node.units.forEach(u => units.add(u.code));
                        if (node.indicators) node.indicators.forEach(i => {
                            if(i.unit_owner) units.add(i.unit_owner);
                        });
                        if (node.children) traverse(node.children);
                    });
                };
                traverse(nodes);
                this.availableUnits = Array.from(units).sort();
            },

            rerenderTree() {
                if(this.searchQuery && this.searchQuery.length > 1) return;
                this.renderTree(this.treeData, document.getElementById('treeRoot'));
            },

            applyFilters() {
                this.rerenderTree();
            },

            async performSearch() {
                if(this.searchQuery.length < 2) {
                    this.renderTree(this.treeData, document.getElementById('treeRoot'));
                    return;
                }
                
                this.loading = true;
                try {
                    const url = `/api/pohon-kinerja/search?q=${this.searchQuery}`;
                    const response = await fetch(url);
                    const results = await response.json();
                    this.renderSearchResults(results, document.getElementById('treeRoot'));
                } catch(e) {
                    console.error("Search error", e)
                } finally {
                    this.loading = false;
                }
            },
            
            openModal(nodeCode) {
                 fetch(`/api/pohon-kinerja/${nodeCode}`)
                    .then(res => res.json())
                    .then(data => {
                        this.selectedNode = data;
                        this.showModal = true;
                    });
            },

            closeModal() {
                this.showModal = false;
            },
            
            selectNode(node) {
                 this.selectedNode = node;
            },

            toggleExpand(code, ulId, caretId) {
                const ul = document.getElementById(ulId);
                const caret = document.getElementById(caretId);
                
                if (this.expandedNodes.has(code)) {
                    this.expandedNodes.delete(code);
                    ul.classList.add('hidden');
                    caret.style.transform = 'rotate(0deg)';
                } else {
                    this.expandedNodes.add(code);
                    ul.classList.remove('hidden');
                    caret.style.transform = 'rotate(90deg)';
                }
            },
            
            expandAll() {
                 const traverse = (list) => {
                    list.forEach(node => {
                        this.expandedNodes.add(node.code);
                        if(node.children) traverse(node.children);
                    });
                };
                traverse(this.treeData);
                this.rerenderTree();
            },
             
            collapseAll() {
                this.expandedNodes.clear();
                // Keep root expanded maybe?
                if(this.treeData.length > 0) this.expandedNodes.add(this.treeData[0].code);
                this.rerenderTree();
            },

            renderSearchResults(results, container) {
                container.innerHTML = '';
                if(results.length === 0) {
                    container.innerHTML = '<li class="text-fg-secondary italic p-4 text-center">Tidak ditemukan hasil.</li>';
                    return;
                }
                results.forEach(node => {
                   const li = document.createElement('li');
                   li.className = 'mb-2 p-3 bg-surface-2 rounded-lg border border-subtle cursor-pointer hover:border-brand-cyan/50 hover:bg-surface-3 transition-all group';
                   li.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div class="flex items-center overflow-hidden gap-3">
                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded border ${this.getLevelBadgeClass(node.level_type)}">${node.level_type}</span>
                                <span class="text-fg-primary text-sm truncate font-medium group-hover:text-brand-cyan transition-colors">${node.title}</span>
                            </div>
                            <button class="text-xs text-brand-cyan opacity-0 group-hover:opacity-100 transition-opacity">Detail →</button>
                        </div>
                   `;
                   li.onclick = () => this.openModal(node.code);
                   container.appendChild(li);
                });
            },

            getLevelBadgeColor(type) {
                // Use semantic semantic colors for badges
                const colors = {
                    'UO': 'bg-red-500/10 text-red-500 border-red-500/20',
                    'IntO_L1': 'bg-orange-500/10 text-orange-500 border-orange-500/20',
                    'IntO_L2': 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20',
                    'ImmO_L3': 'bg-green-500/10 text-green-500 border-green-500/20',
                    'Output': 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                    'Komponen': 'bg-purple-500/10 text-purple-500 border-purple-500/20',
                };
                return colors[type] || 'bg-gray-500/10 text-gray-400 border-gray-500/20';
            },
            
             getLevelBadgeClass(type) {
                return this.getLevelBadgeColor(type);
             },

            renderTree(nodes, container, level = 0) {
                container.innerHTML = '';
                nodes.forEach((node, index) => {
                    this.buildNodeHtml(node, container, level, index === nodes.length - 1);
                });
            },

            buildNodeHtml(node, parentEl, level, isLast) {
                const li = document.createElement('li');
                li.className = 'relative';
                
                const hasChildren = node.children && node.children.length > 0;
                const isExpanded = this.expandedNodes.has(node.code);
                const uniqueId = `node-${node.code.replace(/[^a-zA-Z0-9]/g, '-')}`;
                const ulId = `ul-${uniqueId}`;
                const caretId = `caret-${uniqueId}`;

                const contentDiv = document.createElement('div');
                contentDiv.className = `group relative flex items-center py-2.5 px-3 rounded-lg transition-all duration-200 hover:bg-surface-3 border border-transparent hover:border-subtle`;
                
                const toggleBtn = document.createElement('button');
                toggleBtn.className = `mr-3 w-6 h-6 flex items-center justify-center rounded hover:bg-surface-3 text-fg-secondary transition-colors z-10 ${hasChildren ? 'cursor-pointer hover:text-brand-cyan' : 'opacity-20 cursor-default'}`;
                if(hasChildren) {
                    toggleBtn.innerHTML = `<svg id="${caretId}" class="w-4 h-4 transition-transform duration-200 ${isExpanded ? 'rotate-90 text-brand-cyan' : ''}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>`;
                    toggleBtn.onclick = (e) => {
                        e.stopPropagation();
                        this.toggleExpand(node.code, ulId, caretId);
                    };
                } else {
                    toggleBtn.innerHTML = '<div class="w-2 h-2 rounded-full bg-gray-400/50"></div>';
                }
                
                // Badge
                const badge = document.createElement('span');
                badge.className = `mr-3 px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider border whitespace-nowrap ${this.getLevelBadgeClass(node.level_type)}`;
                badge.textContent = node.level_type;
                
                // Text - Larger and more readable
                const textContainer = document.createElement('div');
                textContainer.className = 'flex-1 min-w-0';
                textContainer.innerHTML = `
                    <div class="text-base font-medium text-fg-primary group-hover:text-fg-primary transition-colors">${node.title}</div>
                    ${this.showCodes ? `<div class="text-xs text-fg-secondary font-mono mt-0.5">${node.code}</div>` : ''}
                `;
                
                // Eye Icon - Always visible
                const detailBtn = document.createElement('button');
                detailBtn.className = 'ml-3 text-fg-secondary hover:text-brand-cyan transition-all px-2 py-2 rounded-lg hover:bg-brand-cyan/10 flex items-center gap-1.5';
                detailBtn.innerHTML = `
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                `;
                 detailBtn.onclick = (e) => {
                    e.stopPropagation();
                    this.openModal(node.code);
                };

                contentDiv.appendChild(toggleBtn);
                contentDiv.appendChild(badge);
                contentDiv.appendChild(textContainer);
                contentDiv.appendChild(detailBtn);
                li.appendChild(contentDiv);

                if (hasChildren) {
                    const ul = document.createElement('ul');
                    ul.id = ulId;
                    ul.className = `ml-[25px] pl-3 border-l border-subtle mt-1 ${isExpanded ? '' : 'hidden'}`;
                    node.children.forEach((child, idx) => {
                        this.buildNodeHtml(child, ul, level + 1, idx === node.children.length - 1);
                    });
                    li.appendChild(ul);
                }

                parentEl.appendChild(li);
            }
        }
    }
</script>
@endpush
@endsection
