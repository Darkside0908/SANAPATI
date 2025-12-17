<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TreeController extends Controller
{
    /**
     * Get tree data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $jsonPath = 'tree/tree.json';
            
            if (!Storage::exists($jsonPath)) {
                return response()->json([
                    'error' => 'Tree data not found',
                    'message' => 'Please run: php artisan tree:generate'
                ], 404);
            }
            
            $jsonContent = Storage::get($jsonPath);
            $data = json_decode($jsonContent, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json([
                    'error' => 'Invalid JSON data',
                    'message' => json_last_error_msg()
                ], 500);
            }
            
            return response()->json($data);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
