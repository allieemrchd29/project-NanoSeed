<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index(Request $request)
{
    $admin = Auth::user();
    $range = $request->input('range', '7_days');
    $endDate = Carbon::now();

    if ($range == 'last_30_days') {
        $startDate = Carbon::now()->subDays(30);
    } elseif ($range == 'this_month') {
        $startDate = Carbon::now()->startOfMonth();
    } else {
        $startDate = Carbon::now()->subDays(7);
    }

    
    $donasi = Donasi::where('status', 'success')
        ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
        ->selectRaw('DATE(created_at) as date, SUM(jumlah_donasi) as total')
        ->groupBy('date')
        ->get()
        ->pluck('total', 'date');

   
    $labels = [];
    $totals = [];
    $current = $startDate->copy();

    while ($current <= $endDate) {
        $dateString = $current->format('Y-m-d');
        $labels[] = $dateString;
        $totals[] = $donasi[$dateString] ?? 0; 
        $current->addDay();
    }

    return view('admin.dashboard', compact('labels', 'totals', 'range', 'admin'));
// Menghitung total donatur unik berdasarkan nama_donatur
    $totalDonatur = \App\Models\Donasi::distinct('nama_donatur')->count('nama_donatur');

    // Pastikan 'totalDonatur' masuk ke dalam compact agar bisa dibaca di View
    return view('admin.dashboard', compact('labels', 'totals', 'range', 'totalDonatur'));
}
}