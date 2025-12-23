<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Units
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // D1, D2, PSSN, etc.
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // 2. Performance Nodes (Tree structure)
        Schema::create('performance_nodes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique(); // UO 1, Int.O.1, etc.
            $table->string('title');
            $table->string('level_type'); // UO, IntO_L1, IntO_L2, ImmO_L3, SS, SP, SK
            $table->uuid('parent_id')->nullable(); 
            $table->string('status')->default('active');
            $table->text('note')->nullable(); // For "not_translated_yet" or other notes
            $table->string('source_page')->nullable();
            $table->timestamps();

            // Self-referencing FK
            $table->foreign('parent_id')->references('id')->on('performance_nodes')->onDelete('cascade');
        });

        // 3. Performance Indicators
        Schema::create('performance_indicators', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('node_id');
            $table->string('code')->nullable(); 
            $table->string('name');
            $table->string('kind'); // IKSS, IKP, IKK, ImmIndicator
            $table->string('unit_owner')->nullable(); // Helper column if not using relation
            $table->string('target')->nullable();
            $table->string('source_page')->nullable();
            $table->timestamps();

            $table->foreign('node_id')->references('id')->on('performance_nodes')->onDelete('cascade');
        });

        // 4. Pivot: Node <-> Units (Many to Many owners)
        Schema::create('node_units', function (Blueprint $table) {
            $table->id();
            $table->uuid('node_id');
            $table->unsignedBigInteger('unit_id');
            $table->timestamps();

            $table->foreign('node_id')->references('id')->on('performance_nodes')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('node_units');
        Schema::dropIfExists('performance_indicators');
        Schema::dropIfExists('performance_nodes');
        Schema::dropIfExists('units');
    }
};
