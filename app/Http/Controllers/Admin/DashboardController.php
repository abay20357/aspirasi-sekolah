<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAspirations = Aspiration::count();
        $pendingAspirations = Aspiration::where('status', 'pending')->count();
        $processAspirations = Aspiration::where('status', 'processed')->count();
        $completedAspirations = Aspiration::where('status', 'completed')->count();
        $todayAspirations = Aspiration::whereDate('created_at', today())->count();
        $totalStudents = User::where('role', 'student')->count();

        // Chart Data: Aspirations per Category
        $categories = Category::withCount('aspirations')->get();
        $chartLabels = $categories->pluck('name');
        $chartData = $categories->pluck('aspirations_count');

        // Recent Aspirations
        $recentAspirations = Aspiration::with(['user', 'category'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalAspirations',
            'pendingAspirations',
            'processAspirations',
            'completedAspirations',
            'todayAspirations',
            'totalStudents',
            'chartLabels',
            'chartData',
            'recentAspirations'
        ));
    }
}
