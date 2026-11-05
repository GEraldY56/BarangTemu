<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Show the form for creating a new report
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created report
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|in:Barang Hilang,Barang Temuan',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'report_date' => 'required|date',
            'report_time' => 'nullable|date_format:H:i',
            'description' => 'required|string',
            'reporter_name' => 'required|string|max:150',
            'reporter_class' => 'required|string|max:100',
            'reporter_contact' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
        }

        // Determine initial status based on type
        $status = $validated['report_type'] === 'Barang Temuan'
            ? 'Sudah Ditemukan'
            : 'Belum Ditemukan';

        Report::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'type' => $validated['report_type'],
            'location' => $validated['location'],
            'report_date' => $validated['report_date'],
            'report_time' => $validated['report_time'],
            'status' => $status,
            'description' => $validated['description'],
            'reporter_name' => $validated['reporter_name'],
            'reporter_class' => $validated['reporter_class'],
            'reporter_contact' => $validated['reporter_contact'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('catalog')
            ->with('success', 'Laporan berhasil dikirim dan diverifikasi sistem!');
    }

    /**
     * Show the form for editing the report (user's own report)
     */
    public function edit($id)
    {
        $report = Report::findOrFail($id);

        // Only allow user to edit their own report
        if ($report->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('reports.edit', compact('report'));
    }

    /**
     * Update the report
     */
    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        // Only allow user to edit their own report
        if ($report->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'report_type' => 'required|in:Barang Hilang,Barang Temuan',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'report_date' => 'required|date',
            'report_time' => 'nullable|date_format:H:i',
            'description' => 'required|string',
            'reporter_name' => 'required|string|max:150',
            'reporter_class' => 'required|string|max:100',
            'reporter_contact' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($report->image_path) {
                Storage::disk('public')->delete($report->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('reports', 'public');
        }

        $validated['type'] = $validated['report_type'];
        unset($validated['report_type']);
        unset($validated['image']);

        $report->update($validated);

        return redirect()->route('catalog')
            ->with('success', 'Laporan berhasil diperbarui!');
    }

    /**
     * Remove the report
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        // Only allow user to delete their own report or admin
        if ($report->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image if exists
        if ($report->image_path) {
            Storage::disk('public')->delete($report->image_path);
        }

        $report->delete();

        return redirect()->route('catalog')->with('success', 'Laporan berhasil dihapus!');
    }
}
