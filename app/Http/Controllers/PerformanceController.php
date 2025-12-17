<?php

namespace App\Http\Controllers;

use App\Models\PerformanceNode;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource (Tree structure).
     */
    public function index()
    {
        // Fetch all nodes with relationships
        $nodes = PerformanceNode::with(['indicators', 'units'])->orderBy('code')->get();

        // Build Tree in Memory
        $tree = [];
        $nodeMap = [];

        // 1. Map by ID
        foreach ($nodes as $node) {
            $node->setAttribute('children', []); // Initialize children
            $nodeMap[$node->id] = $node;
        }

        // 2. Assign to parents
        foreach ($nodes as $node) {
            if ($node->parent_id && isset($nodeMap[$node->parent_id])) {
                $parent = $nodeMap[$node->parent_id];
                $children = $parent->children; // get current array
                $children[] = $node; // add
                $parent->setAttribute('children', $children); // set back
            } else {
                $tree[] = $node; // Root node
            }
        }

        return response()->json($tree);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        $node = PerformanceNode::where('code', $code)
            ->with(['indicators', 'units', 'parent', 'children.indicators', 'children.units'])
            ->firstOrFail();

        // Build breadcrumb
        $breadcrumb = [];
        $current = $node;
        while ($current->parent) {
            array_unshift($breadcrumb, [
                'code' => $current->parent->code,
                'title' => $current->parent->title,
                'level_type' => $current->parent->level_type
            ]);
            $current = $current->parent;
        }
        $node->setAttribute('breadcrumb', $breadcrumb);

        return response()->json($node);
    }

    public function search(Request $request)
    {
        $q = $request->query('q');
        if (!$q) {
            return response()->json([]);
        }

        $nodes = PerformanceNode::where('title', 'like', "%{$q}%")
            ->orWhere('code', 'like', "%{$q}%")
            ->orWhereHas('indicators', function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%");
            })
            ->orWhereHas('units', function($query) use ($q) {
                $query->where('code', 'like', "%{$q}%")->orWhere('name', 'like', "%{$q}%");
            })
            ->with(['units', 'indicators'])
            ->limit(50)
            ->get();

        return response()->json($nodes);
    }
}
