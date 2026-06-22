<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KepuasanWarga;
use Illuminate\Http\Request;

class KepuasanAdminController extends Controller
{
    /**
     * Display a listing of the kepuasan (reviews).
     */
    public function index(Request $request)
    {
        $query = KepuasanWarga::with('masyarakat');

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->whereHas('masyarakat', function($u) use ($search) {
                $u->where('name', 'LIKE', "%$search%")
                  ->orWhere('nama', 'LIKE', "%$search%");
            });
        }

        if ($request->filled('layanan')) {
            $query->where('status_layanan', $request->layanan);
        }

        if ($request->filled('rating')) {
            $query->where('nilai_kepuasan', $request->rating);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_input', $request->tanggal);
        }

        $reviews = $query->orderBy('tanggal_input', 'desc')
            ->paginate(20)
            ->withQueryString();

        $totalPenilaian = KepuasanWarga::count();
        $avgKeseluruhan = KepuasanWarga::avg('nilai_kepuasan') ?? 0;

        $layananTerbanyak = KepuasanWarga::select('status_layanan')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('status_layanan')
            ->orderBy('total', 'desc')
            ->first();
        $layananTerbanyakNama = $layananTerbanyak ? $layananTerbanyak->status_layanan : '-';
            
        return view('admin.kepuasan.index', compact('reviews', 'totalPenilaian', 'avgKeseluruhan', 'layananTerbanyakNama'));
    }

    /**
     * Update the admin response and status.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'admin_response' => 'required|string|max:1000',
        ]);

        $kepuasan = KepuasanWarga::findOrFail($id);
        $kepuasan->admin_response = $request->admin_response;
        $kepuasan->status = 'followed_up';
        $kepuasan->save();

        return redirect()->route('admin.kepuasan.index')->with('success', 'Balasan berhasil dikirim dan status diperbarui.');
    }

    public function dashboard(Request $request)
    {
        $query = KepuasanWarga::with('masyarakat');

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->whereHas('masyarakat', function($u) use ($search) {
                $u->where('name', 'LIKE', "%$search%")
                  ->orWhere('nama', 'LIKE', "%$search%");
            });
        }

        if ($request->filled('layanan')) {
            $query->where('status_layanan', $request->layanan);
        }

        if ($request->filled('rating')) {
            $query->where('nilai_kepuasan', $request->rating);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_input', $request->tanggal);
        }

        $reviews = $query->orderBy('tanggal_input', 'desc')
            ->paginate(20)
            ->withQueryString();

        $totalPenilaian = KepuasanWarga::count();
        $avgKeseluruhan = KepuasanWarga::avg('nilai_kepuasan') ?? 0;

        $layananTerbanyak = KepuasanWarga::select('status_layanan')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('status_layanan')
            ->orderBy('total', 'desc')
            ->first();
        $layananTerbanyakNama = $layananTerbanyak ? $layananTerbanyak->status_layanan : '-';
            
        return view('admin.kepuasan.dashboard', compact('reviews', 'totalPenilaian', 'avgKeseluruhan', 'layananTerbanyakNama'));
    }

    public function saran()
    {
        $reviews = KepuasanWarga::with('masyarakat')
            ->whereNotNull('kritik_saran')
            ->where('kritik_saran', '!=', '')
            ->orderBy('tanggal_input', 'desc')
            ->paginate(20);
            
        return view('admin.kepuasan.saran', compact('reviews'));
    }

    public function laporan(Request $request)
    {
        $query = KepuasanWarga::with('masyarakat')->orderBy('tanggal_input', 'desc');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_input', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $reviews = $query->get();
            
        return view('admin.kepuasan.laporan', compact('reviews'));
    }
}
