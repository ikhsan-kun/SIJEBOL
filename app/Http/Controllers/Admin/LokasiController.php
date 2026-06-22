<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiJebol;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $query = LokasiJebol::query();

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_lokasi', 'LIKE', "%$search%")
                  ->orWhere('kecamatan', 'LIKE', "%$search%")
                  ->orWhere('kelurahan', 'LIKE', "%$search%");
            });
        }

        $lokasi = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.lokasi.index', compact('lokasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'kuota_peserta' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        LokasiJebol::create($request->all());

        return redirect()->route('admin.lokasi.index')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'kuota_peserta' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $lokasi = LokasiJebol::findOrFail($id);
        $lokasi->update($request->all());

        return redirect()->route('admin.lokasi.index')->with('success', 'Lokasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $lokasi = LokasiJebol::findOrFail($id);
        $lokasi->delete();

        return redirect()->route('admin.lokasi.index')->with('success', 'Lokasi berhasil dihapus!');
    }
}
