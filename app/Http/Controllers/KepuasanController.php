<?php

namespace App\Http\Controllers;

use App\Models\KepuasanWarga;
use App\Models\PengajuanLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KepuasanController extends Controller
{
    /**
     * Display the kepuasan form with history.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua pengajuan layanan yang sudah selesai milik user
        $pengajuanSelesai = PengajuanLayanan::where('nik', $user->nik)
            ->where('status', 'selesai')
            ->orderByDesc('tanggal_selesai')
            ->get();

        $riwayatAll = KepuasanWarga::where('nik', $user->nik)->get();

        $riwayat = KepuasanWarga::with('masyarakat')
            ->where('nik', $user->nik)
            ->orderByDesc('tanggal_input')
            ->paginate(5);

        return view('masyarakat.kepuasan', compact('riwayat', 'riwayatAll', 'pengajuanSelesai'));
    }

    /**
     * Store a new kepuasan entry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nilai_kepuasan' => 'required|in:1,2,3,4,5',
            'status_layanan' => 'required|string',
            'kritik_saran'   => 'nullable|string|max:2000',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('kepuasan_warga', 'public');
        }

        KepuasanWarga::create([
            'nik'             => Auth::user()->nik,
            'nilai_kepuasan'  => $validated['nilai_kepuasan'],
            'rating_kecepatan'=> $request->input('rating_kecepatan', 0),
            'rating_kemudahan'=> $request->input('rating_kemudahan', 0),
            'rating_keramahan'=> $request->input('rating_keramahan', 0),
            'rating_kejelasan'=> $request->input('rating_kejelasan', 0),
            'status_layanan'  => $validated['status_layanan'],
            'kritik_saran'    => $validated['kritik_saran'] ?? null,
            'foto_path'       => $fotoPath,
            'tanggal_input'   => now(),
        ]);

        return redirect()->back()->with('status', 'Terima kasih! Penilaian Anda telah kami terima. 🎉');
    }
}
