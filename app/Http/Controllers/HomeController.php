<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display homepage with statistics and recent reports
     */
    public function index()
    {
        // Get statistics
        $stats = [
            'total' => Report::count(),
            'found' => Report::where('status', 'Sudah Ditemukan')->count(),
            'returned' => Report::where('status', 'Sudah Dikembalikan')->count(),
            'pending' => Report::where('status', 'Belum Ditemukan')->count(),
        ];

        // Get recent 4 reports
        $recentReports = Report::with('user')
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact('stats', 'recentReports'));
    }

    /**
     * Display catalog/daftar barang with filters
     */
    public function catalog(Request $request)
    {
        $query = Report::with('user')->latest();

        // Apply filters
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('type')) {
            $query->byType($request->type);
        }

        $reports = $query->paginate(12);

        return view('catalog', compact('reports'));
    }

    /**
     * Display report detail
     */
    public function show($id)
    {
        $report = Report::with('user')->findOrFail($id);
        return view('reports.show', compact('report'));
    }
}
