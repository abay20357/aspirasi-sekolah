<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalAspirations = $user->aspirations()->count();
        $pendingAspirations = $user->aspirations()->where('status', 'pending')->count();
        $processAspirations = $user->aspirations()->where('status', 'processing')->count();
        $completedAspirations = $user->aspirations()->where('status', 'done')->count();

        // Get recent aspirations
        $recentAspirations = $user->aspirations()->with('category')->latest()->take(5)->get();

        return view('student.dashboard', compact('totalAspirations', 'pendingAspirations', 'processAspirations', 'completedAspirations', 'recentAspirations'));
    }
}
