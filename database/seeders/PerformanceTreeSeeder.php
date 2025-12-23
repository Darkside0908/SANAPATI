<?php

namespace Database\Seeders;

use App\Models\PerformanceIndicator;
use App\Models\PerformanceNode;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PerformanceTreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/tree/tree.json');

        if (!File::exists($path)) {
            $this->command->error("File not found: $path");
            return;
        }

        $json = File::get($path);
        $data = json_decode($json, true);

        if (!$data || !isset($data['nodes'])) {
            $this->command->error("Invalid JSON structure");
            return;
        }

        DB::transaction(function () use ($data) {
            // Clear existing data
            \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
            PerformanceNode::truncate();
            PerformanceIndicator::truncate();
            Unit::truncate();
            DB::table('node_units')->truncate();
            \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

            $nodes = $data['nodes'];
            $codeToIdMap = [];

            // 1. First pass: Collect all Units and Create them
            $allUnits = [];
            foreach ($nodes as $nodeData) {
                // Check 'units' or 'owners'
                $unitCodes = $nodeData['units'] ?? $nodeData['owners'] ?? [];
                if (is_array($unitCodes)) {
                    foreach ($unitCodes as $unitCode) {
                        $allUnits[$unitCode] = true;
                    }
                }
                // Check indicators for unit_owner
                if (isset($nodeData['indicators']) && is_array($nodeData['indicators'])) {
                    foreach ($nodeData['indicators'] as $ind) {
                        if (isset($ind['unit_owner']) && $ind['unit_owner']) {
                            $allUnits[$ind['unit_owner']] = true;
                        }
                    }
                }
            }

            foreach (array_keys($allUnits) as $code) {
                Unit::firstOrCreate(['code' => $code], ['name' => "Unit $code"]);
            }

            $unitMap = Unit::pluck('id', 'code')->toArray();

            // 2. Sort nodes by level/parentage dependency?
            // A simple way is to insert parents first.
            // But since 'nodes' might be mixed, we can sort by level_type priority or
            // just loop multiple times until all are inserted, or topological sort.
            // Given the hierarchy UO -> Int.O -> Int.O.x -> Imm.O -> SS -> SP -> SK
            // We can also assume the JSON generator generally respects order or we can rely on null parent first.
            
            // Let's sort: nodes with parent_code=null first.
            // Then nodes whose parent_code is in map.            
            
            $pending = $nodes;
            $insertedCount = 0;
            $maxLoops = 100; // safety
            $loop = 0;

            while (count($pending) > 0 && $loop < $maxLoops) {
                $loop++;
                $nextPending = [];
                $processedInThisLoop = 0;

                foreach ($pending as $nodeData) {
                    $pCode = $nodeData['parent_code'] ?? null;
                    
                    // Can insert if root or parent already inserted
                    if (is_null($pCode) || isset($codeToIdMap[$pCode])) {
                        
                        $node = PerformanceNode::create([
                            'code' => $nodeData['code'],
                            'title' => $nodeData['title'],
                            'level_type' => $nodeData['level_type'],
                            'parent_id' => $pCode ? $codeToIdMap[$pCode] : null,
                            'status' => $nodeData['status'] ?? 'active',
                            'note' => $nodeData['note'] ?? null,
                            'source_page' => $nodeData['source_page'] ?? null,
                        ]);

                        $codeToIdMap[$nodeData['code']] = $node->id;
                        $processedInThisLoop++;

                        // Attach Owners
                        $unitCodes = $nodeData['units'] ?? $nodeData['owners'] ?? [];
                        if (is_array($unitCodes)) {
                            $unitIds = [];
                            foreach ($unitCodes as $uCode) {
                                if (isset($unitMap[$uCode])) {
                                    $unitIds[] = $unitMap[$uCode];
                                }
                            }
                            $node->units()->sync($unitIds);
                        }

                        // Create Indicators
                        if (isset($nodeData['indicators']) && is_array($nodeData['indicators'])) {
                            foreach ($nodeData['indicators'] as $indData) {
                                PerformanceIndicator::create([
                                    'node_id' => $node->id,
                                    'code' => $indData['code'] ?? null,
                                    'name' => $indData['name'],
                                    'kind' => $indData['kind'] ?? 'General',
                                    'unit_owner' => $indData['unit_owner'] ?? null,
                                    'target' => $indData['target'] ?? null,
                                    'source_page' => $indData['source_page'] ?? null,
                                ]);
                            }
                        }

                    } else {
                        $nextPending[] = $nodeData;
                    }
                }
                
                if ($processedInThisLoop === 0 && count($nextPending) > 0) {
                     $this->command->warn("Stuck with " . count($nextPending) . " nodes missing parents.");
                     // Force insert remaining as roots? or Log error
                     // For now, break to avoid infinite loop
                     foreach($nextPending as $stuck) {
                         $this->command->error("Missing parent: " . ($stuck['parent_code'] ?? 'none') . " for " . $stuck['code']);
                     }
                     break;
                }
                
                $pending = $nextPending;
            }
        });
    }
}
