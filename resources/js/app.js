import Alpine from 'alpinejs'

// Make Alpine available globally
window.Alpine = Alpine

// Tree component for performance management
Alpine.data('treeView', () => ({
    nodes: [],
    expanded: {},
    selected: null,
    filter: '',
    loading: true,

    async init() {
        await this.loadTree()
    },

    async loadTree() {
        try {
            const response = await fetch('/api/tree')
            const data = await response.json()
            this.nodes = data.nodes || []
            this.loading = false
        } catch (error) {
            console.error('Failed to load tree:', error)
            this.loading = false
        }
    },

    get tree() {
        if (this.filter.trim() === '') {
            return this.buildTree(this.nodes)
        }
        return this.filterTree()
    },

    buildTree(nodes, parentId = null) {
        return nodes
            .filter(node => node.parent_id === parentId)
            .map(node => ({
                ...node,
                children: this.buildTree(nodes, node.id)
            }))
    },

    filterTree() {
        const query = this.filter.toLowerCase()
        const filtered = this.nodes.filter(node =>
            node.label.toLowerCase().includes(query) ||
            (node.code && node.code.toLowerCase().includes(query))
        )

        // Auto-expand parents of filtered results
        filtered.forEach(node => {
            this.expandParents(node.id)
        })

        return this.buildTree(filtered)
    },

    expandParents(nodeId) {
        const node = this.nodes.find(n => n.id === nodeId)
        if (node && node.parent_id) {
            this.expanded[node.parent_id] = true
            this.expandParents(node.parent_id)
        }
    },

    toggle(nodeId) {
        this.expanded[nodeId] = !this.expanded[nodeId]
    },

    isExpanded(nodeId) {
        return this.expanded[nodeId] || false
    },

    select(node) {
        this.selected = node
    },

    expandAll() {
        this.nodes.forEach(node => {
            this.expanded[node.id] = true
        })
    },

    collapseAll() {
        this.expanded = {}
    },

    resetFilter() {
        this.filter = ''
        this.collapseAll()
    },

    getBreadcrumb(nodeId) {
        const breadcrumb = []
        let currentId = nodeId

        while (currentId) {
            const node = this.nodes.find(n => n.id === currentId)
            if (node) {
                breadcrumb.unshift(node)
                currentId = node.parent_id
            } else {
                break
            }
        }

        return breadcrumb
    },

    getChildren(nodeId) {
        return this.nodes.filter(n => n.parent_id === nodeId)
    },

    getBadgeClass(type) {
        const classes = {
            'outcome': 'badge-outcome',
            'sasaran': 'badge-sasaran',
            'program': 'badge-program',
            'kegiatan': 'badge-kegiatan',
            'indikator': 'badge-indikator'
        }
        return `badge ${classes[type] || 'badge-outcome'}`
    }
}))

Alpine.start()
