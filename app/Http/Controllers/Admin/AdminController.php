<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index(Request $request)
    {
        $query = Report::with('user')->latest();

        // Filter by status if provided
        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        $reports = $query->paginate(20);

        // Get statistics
        $stats = [
            'total' => Report::count(),
            'found' => Report::where('status', 'Sudah Ditemukan')->count(),
            'returned' => Report::where('status', 'Sudah Dikembalikan')->count(),
            'pending' => Report::where('status', 'Belum Ditemukan')->count(),
        ];

        return view('admin.dashboard', compact('reports', 'stats'));
    }

    /**
     * Update report status (Admin only)
     */
    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Belum Ditemukan,Sudah Ditemukan,Sudah Dikembalikan'
        ]);

        $report->update(['status' => $validated['status']]);

        return back()->with('success', "Status laporan #{$id} diperbarui menjadi: {$validated['status']}");
    }

    /**
     * Delete report (Admin only)
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        // Delete image if exists
        if ($report->image_path) {
            Storage::disk('public')->delete($report->image_path);
        }

        $report->delete();

        return back()->with('success', "Laporan #{$id} berhasil dihapus dari sistem.");
    }

    /**
     * Export report data (placeholder for future implementation)
     */
    public function export()
    {
        // This can be implemented with Laravel Excel or similar package
        return back()->with('info', 'Fitur export sedang dalam pengembangan.');
    }
}
