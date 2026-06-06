<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMaterial = Material::count();
        $statusAman = Material::where('status', 'Aman')->count();
        $statusWarning = Material::where('status', 'Warning')->count();
        $statusKritis = Material::where('status', 'Reorder/Kritis')->count();
        $statusStockOut = Material::where('status', 'Stock Out')->count();

        $topKritis = Material::whereIn('status', ['Stock Out', 'Reorder/Kritis', 'Warning'])
            ->orderByRaw("FIELD(status, 'Stock Out', 'Reorder/Kritis', 'Warning')")
            ->limit(10)
            ->get();

        $notifications = Material::whereIn('status', ['Stock Out', 'Reorder/Kritis', 'Warning'])
            ->orderByRaw("FIELD(status, 'Stock Out', 'Reorder/Kritis', 'Warning')")
            ->get();

        $chartData = [
            'labels' => ['Aman', 'Warning', 'Reorder/Kritis', 'Stock Out'],
            'data' => [$statusAman, $statusWarning, $statusKritis, $statusStockOut],
        ];

        return view('dashboard', compact(
            'totalMaterial',
            'statusAman',
            'statusWarning',
            'statusKritis',
            'statusStockOut',
            'topKritis',
            'chartData',
            'notifications'
        ));
    }
}
