<?php

namespace App\Console\Commands;

use App\Models\PerformanceNode;
use App\Models\PerformanceIndicator;
use App\Models\Unit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTreeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tree:import {--fresh : Clear all existing data before import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import performance tree data from tree.json to database';

    private $nodeMap = []; // Map code => node_id for relationship building
    private $unitMap = []; // Map unit code => unit_id

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting tree data import...');

        // Use direct file path since tree.json is in storage/app/tree, not in the 'local' disk
        $filePath = storage_path('app/tree/tree.json');

        // Check if file exists
        if (!file_exists($filePath)) {
            $this->error("tree.json not found at {$filePath}");
            return 1;
        }

        // Read and parse JSON
        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON: ' . json_last_error_msg());
            return 1;
        }

        if (!isset($data['nodes']) || !is_array($data['nodes'])) {
            $this->error('Invalid JSON structure: "nodes" array not found');
            return 1;
        }

        DB::beginTransaction();

        try {
            // Clear existing data if --fresh flag is provided
            if ($this->option('fresh')) {
                $this->warn('Clearing existing data...');
                DB::table('node_units')->truncate();
                PerformanceIndicator::query()->delete();
                PerformanceNode::query()->delete();
                Unit::query()->delete();
                $this->info('✓ Existing data cleared');
            }

            $nodes = $data['nodes'];
            $this->info("Found " . count($nodes) . " nodes to import");

            // First pass: Create all nodes without parent relationships
            $this->info('Pass 1: Creating nodes...');
            $bar = $this->output->createProgressBar(count($nodes));
            
            foreach ($nodes as $nodeData) {
                $this->createNode($nodeData);
                $bar->advance();
            }
            
            $bar->finish();
            $this->newLine();

            // Second pass: Update parent relationships
            $this->info('Pass 2: Building relationships...');
            $bar = $this->output->createProgressBar(count($nodes));
            
            foreach ($nodes as $nodeData) {
                $this->updateNodeParent($nodeData);
                $bar->advance();
            }
            
            $bar->finish();
            $this->newLine();

            DB::commit();

            $this->newLine();
            $this->info('✓ Import completed successfully!');
            $this->info("  - Nodes: " . count($this->nodeMap));
            $this->info("  - Units: " . count($this->unitMap));

            return 0;

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Import failed: ' . $e->getMessage());
            $this->error('Line: ' . $e->getLine() . ' in ' . $e->getFile());
            return 1;
        }
    }

    private function createNode(array $data)
    {
        // Create or update the node
        $node = PerformanceNode::updateOrCreate(
            ['code' => $data['code']],
            [
                'title' => $data['title'] ?? '',
                'level_type' => $data['level_type'] ?? 'unknown',
                'note' => $data['note'] ?? null,
                'source_page' => $data['source_page'] ?? null,
            ]
        );

        // Store in map for later parent relationship building
        $this->nodeMap[$data['code']] = $node->id;

        // Import indicators
        if (isset($data['indicators']) && is_array($data['indicators'])) {
            foreach ($data['indicators'] as $indicatorData) {
                PerformanceIndicator::updateOrCreate(
                    [
                        'node_id' => $node->id,
                        'name' => $indicatorData['name'] ?? '',
                    ],
                    [
                        'code' => $indicatorData['code'] ?? null,
                        'kind' => $indicatorData['kind'] ?? 'unknown',
                        'unit_owner' => $indicatorData['unit_owner'] ?? null,
                        'target' => $indicatorData['target'] ?? null,
                    ]
                );
            }
        }

        // Import units (many-to-many relationship)
        if (isset($data['units']) && is_array($data['units'])) {
            $unitIds = [];
            foreach ($data['units'] as $unitCode) {
                $unit = $this->getOrCreateUnit($unitCode);
                $unitIds[] = $unit->id;
            }
            $node->units()->sync($unitIds);
        }
    }

    private function updateNodeParent(array $data)
    {
        if (isset($data['parent_code']) && $data['parent_code']) {
            $parentId = $this->nodeMap[$data['parent_code']] ?? null;
            if ($parentId) {
                PerformanceNode::where('code', $data['code'])->update([
                    'parent_id' => $parentId
                ]);
            }
        }
    }

    private function getOrCreateUnit(string $code)
    {
        if (isset($this->unitMap[$code])) {
            return Unit::find($this->unitMap[$code]);
        }

        $unit = Unit::firstOrCreate(
            ['code' => $code],
            ['name' => $code] // Use code as name if not provided
        );

        $this->unitMap[$code] = $unit->id;

        return $unit;
    }
}
