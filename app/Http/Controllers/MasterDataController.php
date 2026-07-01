<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterKecamatan;
use App\Models\MasterKelurahan;
use App\Models\MasterJenisLayanan;
use App\Models\MasterStatusLayanan;

class MasterDataController extends Controller
{
    public function index()
    {

        $kecamatan = MasterKecamatan::all();
        $kelurahan = MasterKelurahan::all();
        
        $wilayahCount = count($kecamatan) + count($kelurahan);

        $jenisLayanan = MasterJenisLayanan::all();
        $statusLayanan = MasterStatusLayanan::all();
        $adminCount = \App\Models\Admin::count() + \App\Models\User::whereIn('role', ['admin', 'Admin Pusat'])->count();
        $userCount = \App\Models\User::whereNotIn('role', ['admin', 'Admin Pusat'])->count();
        $petugasCount = $adminCount + $userCount;
        
        $regionalTargets = \Illuminate\Support\Facades\Schema::hasTable('regional_targets') 
            ? \App\Models\RegionalTarget::orderBy('kecamatan')->get() 
            : collect([]);

        $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        $activities = collect([]);

        return view('admin.master-data', compact('kecamatan', 'kelurahan', 'wilayahCount', 'jenisLayanan', 'statusLayanan', 'regionalTargets', 'petugasCount', 'adminCount', 'userCount', 'users', 'activities'));
    }

    private function logActivity($action, $item)
    {
        // Fitur log_activity (master_activities) dihapus untuk membersihkan database
    }

    // --- KECAMATAN ---
    public function storeKecamatan(Request $request)
    {
        $data = MasterKecamatan::create($request->all());
        $this->logActivity('Tambah', 'Kecamatan ' . $data->nama);
        return redirect()->back()->with('success', 'Data Kecamatan berhasil ditambahkan');
    }

    public function updateKecamatan(Request $request, $id)
    {
        $data = MasterKecamatan::findOrFail($id);
        $data->update($request->all());
        $this->logActivity('Ubah', 'Kecamatan ' . $data->nama);
        return redirect()->back()->with('success', 'Data Kecamatan berhasil diperbarui');
    }

    public function destroyKecamatan($id)
    {
        $data = MasterKecamatan::find($id);
        if ($data) {
            $this->logActivity('Hapus', 'Kecamatan ' . $data->nama);
            $data->delete();
        }
        return redirect()->back()->with('success', 'Data Kecamatan berhasil dihapus');
    }

    // --- KELURAHAN ---
    public function storeKelurahan(Request $request)
    {
        $data = MasterKelurahan::create($request->all());
        $this->logActivity('Tambah', 'Kelurahan ' . $data->nama);
        return redirect()->back()->with('success', 'Data Kelurahan berhasil ditambahkan');
    }

    public function updateKelurahan(Request $request, $id)
    {
        $data = MasterKelurahan::findOrFail($id);
        $data->update($request->all());
        $this->logActivity('Ubah', 'Kelurahan ' . $data->nama);
        return redirect()->back()->with('success', 'Data Kelurahan berhasil diperbarui');
    }

    public function destroyKelurahan($id)
    {
        $data = MasterKelurahan::find($id);
        if ($data) {
            $this->logActivity('Hapus', 'Kelurahan ' . $data->nama);
            $data->delete();
        }
        return redirect()->back()->with('success', 'Data Kelurahan berhasil dihapus');
    }

    // --- JENIS LAYANAN ---
    public function storeJenisLayanan(Request $request)
    {
        $data = MasterJenisLayanan::create($request->all());
        $this->logActivity('Tambah', 'Layanan ' . $data->nama);
        return redirect()->back()->with('success', 'Data Jenis Layanan berhasil ditambahkan');
    }

    public function updateJenisLayanan(Request $request, $id)
    {
        $data = MasterJenisLayanan::findOrFail($id);
        $data->update($request->all());
        $this->logActivity('Ubah', 'Layanan ' . $data->nama);
        return redirect()->back()->with('success', 'Data Jenis Layanan berhasil diperbarui');
    }

    public function destroyJenisLayanan($id)
    {
        $data = MasterJenisLayanan::find($id);
        if ($data) {
            $this->logActivity('Hapus', 'Layanan ' . $data->nama);
            $data->delete();
        }
        return redirect()->back()->with('success', 'Data Jenis Layanan berhasil dihapus');
    }

    // --- STATUS LAYANAN ---
    public function storeStatusLayanan(Request $request)
    {
        $data = MasterStatusLayanan::create($request->all());
        $this->logActivity('Tambah', 'Status ' . $data->nama);
        return redirect()->back()->with('success', 'Data Status Layanan berhasil ditambahkan');
    }

    public function updateStatusLayanan(Request $request, $id)
    {
        $data = MasterStatusLayanan::findOrFail($id);
        $data->update($request->all());
        $this->logActivity('Ubah', 'Status ' . $data->nama);
        return redirect()->back()->with('success', 'Data Status Layanan berhasil diperbarui');
    }

    public function destroyStatusLayanan($id)
    {
        $data = MasterStatusLayanan::find($id);
        if ($data) {
            $this->logActivity('Hapus', 'Status ' . $data->nama);
            $data->delete();
        }
        return redirect()->back()->with('success', 'Data Status Layanan berhasil dihapus');
    }

    // --- PETUGAS / ROLE ---
    public function storePetugas(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'foto' => 'nullable|image|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('profile-photos', 'public');
        }

        $data = \App\Models\User::create([
            'name' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $request->role,
            'alamat' => $request->alamat,
            'kecamatan' => $request->wilayah,
            'foto_profil' => $fotoPath,
            'phone' => '08' . rand(100000000, 999999999),
            'location_type' => 'kota',
        ]);

        $this->logActivity('Tambah', 'Petugas ' . $data->name);
        return redirect()->back()->with('success', 'Akun petugas berhasil ditambahkan!')->with('active_tab', 'Petugas / Role');
    }

    public function updatePetugas(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email,' . $id,
            'role' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user->name = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->alamat = $request->alamat;
        $user->kecamatan = $request->wilayah;
        if ($request->filled('nik')) {
            $user->nik = $request->nik;
        }

        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto_profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->foto_profil)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->foto_profil);
            }
            $fotoPath = $request->file('foto')->store('profile-photos', 'public');
            $user->foto_profil = $fotoPath;
        }

        $user->save();
        $this->logActivity('Ubah', 'Petugas ' . $user->name);

        return redirect()->back()->with('success', 'Akun petugas berhasil diupdate!')->with('active_tab', 'Petugas / Role');
    }

    public function destroyPetugas($id)
    {
        $user = \App\Models\User::find($id);
        if ($user) {
            if ($user->foto_profil) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->foto_profil);
            }
            $this->logActivity('Hapus', 'Petugas ' . $user->name);
            $user->delete();
        }

        return redirect()->back()->with('success', 'Akun Petugas berhasil dihapus!');
    }
}
