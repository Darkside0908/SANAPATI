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
        $unit = $request->query('unit');

        if (!$q && !$unit) {
            return response()->json([]);
        }

        $query = PerformanceNode::query();

        if ($unit) {
            $query->where(function($sub) use ($unit) {
                $sub->whereHas('units', function($u) use ($unit) {
                    $u->where('code', $unit);
                })->orWhereHas('indicators', function($i) use ($unit) {
                    $i->where('unit_owner', $unit);
                });
            });
        }

        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('code', 'like', "%{$q}%")
                    ->orWhereHas('indicators', function($ind) use ($q) {
                        $ind->where('name', 'like', "%{$q}%");
                    })
                    ->orWhereHas('units', function($u) use ($q) {
                        $u->where('code', 'like', "%{$q}%")->orWhere('name', 'like', "%{$q}%");
                    });
            });
        }

        $nodes = $query->with(['units', 'indicators'])
            ->limit(50)
            ->get();

        return response()->json($nodes);
    }
}
