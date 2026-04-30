<?php

namespace App\Http\Controllers;

use App\Models\DynamicEntity;
use App\Models\DynamicRecord;
use App\Models\User;
use App\Models\ProgramStudi;
use App\Services\DashboardAggregationService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected DashboardAggregationService $aggregationService;

    public function __construct(DashboardAggregationService $aggregationService)
    {
        $this->aggregationService = $aggregationService;
    }

    public function index(Request $request)
    {
        $user = $request->user();

        // Core stats
        $stats = [
            'total_dosen' => DynamicRecord::whereHas('entity', fn($q) => $q->where('root_category', 'dosen'))->count(),
            'total_mahasiswa' => DynamicRecord::whereHas('entity', fn($q) => $q->where('root_category', 'mahasiswa'))->count(),
            'total_entities' => DynamicEntity::active()->count(),
            'total_prodi' => ProgramStudi::where('is_active', true)->count(),
        ];

        // Get all active entities grouped by category
        $dosenEntities = DynamicEntity::active()
            ->byCategory('dosen')
            ->withCount('records')
            ->orderBy('sort_order')
            ->get();

        $mahasiswaEntities = DynamicEntity::active()
            ->byCategory('mahasiswa')
            ->withCount('records')
            ->orderBy('sort_order')
            ->get();

        // Get aggregation data for charts
        $chartData = $this->aggregationService->getChartData();

        // Recent records
        $recentRecords = DynamicRecord::with(['entity', 'creator', 'programStudi'])
            ->latest()
            ->limit(10)
            ->get();

        // Program Studi distribution
        $prodiDistribution = $this->aggregationService->getProdiDistribution();

        return view('dashboard.index', compact(
            'stats',
            'dosenEntities',
            'mahasiswaEntities',
            'chartData',
            'recentRecords',
            'prodiDistribution'
        ));
    }
}
