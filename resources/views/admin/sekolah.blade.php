@extends('layouts.panel')

@section('title', 'Data Sekolah - SI JEBOL Admin')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        color: white;
        padding: 36px 48px;
        position: relative;
        overflow: hidden;
        margin: -2rem -2rem 32px -2rem;
        box-shadow: 0 10px 30px rgba(0, 49, 120, 0.15);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 6px solid var(--accent, #f59e0b);
    }

    .page-header::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url('{{ asset("images/batik-tegal-premium.jpg") }}');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        mix-blend-mode: overlay;
        pointer-events: none;
    }

    .header-content { position: relative; z-index: 10; }
    .header-title { font-size: 1.8rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.5px; display: flex; align-items: center; gap: 12px; }
    .header-subtitle { font-size: 0.95rem; color: rgba(255,255,255,0.8); margin: 0; font-weight: 500; }

    .header-actions { position: relative; z-index: 10; }

    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        text-decoration: none;
    }

    .btn-warning { background: #f59e0b; color: #78350f; }
    .btn-warning:hover { background: #d97706; color: white; transform: translateY(-2px); }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.02);
        display: flex;
        flex-direction: column;
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -8px rgba(0,0,0,0.08);
        border-color: #e2e8f0;
    }

    .stat-label { font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
    .stat-value { font-size: 2.2rem; font-weight: 800; color: var(--text-main); line-height: 1; margin-bottom: 4px; }

    .panel-box {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
        margin-bottom: 24px;
    }

    /* Search bar */
    .search-container {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .search-form {
        display: flex;
        align-items: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 8px 16px;
        flex: 1;
        max-width: 500px;
        transition: all 0.2s;
    }
    .search-form:focus-within { border-color: var(--primary); background: white; box-shadow: 0 0 0 3px rgba(0, 49, 120, 0.1); }
    .search-input { border: none; background: transparent; outline: none; padding: 8px; width: 100%; font-size: 0.95rem; }

    /* Data Table */
    .data-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .data-table th, .data-table td { padding: 16px; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; vertical-align: middle; }
    .data-table th { background: #f8fafc; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.8rem; text-align: left; }
    .data-table th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .data-table th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
    .data-table tbody tr:hover { background: #f8fafc; }

    .school-info { display: flex; flex-direction: column; gap: 4px; }
    .school-name { font-weight: 700; color: var(--text-main); font-size: 1rem; }
    
    .badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-primary { background: #e0e7ff; color: #4338ca; border: 1px solid #c7d2fe; }
    .badge-warning { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
    .badge-success { background: #ecfdf5; color: #10b981; border: 1px solid #a7f3d0; }
    .badge-neutral { background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; }

    .action-btn { width: 32px; height: 32px; border-radius: 8px; display: inline-grid; place-items: center; color: var(--text-muted); background: #f1f5f9; transition: all 0.2s; border: none; cursor: pointer; }
    .action-btn:hover { background: #e2e8f0; color: var(--text-main); }
    .action-btn.edit:hover { background: #dbeafe; color: #2563eb; }

    .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-weight: 500; }

    /* Modals */
    .modal-backdrop { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 1000; display: none; place-items: center; opacity: 0; transition: opacity 0.3s ease; }
    .modal-backdrop.show { display: grid; opacity: 1; }
    .modal-content { background: white; border-radius: 20px; width: 100%; max-width: 550px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); transform: scale(0.95); opacity: 0; transition: all 0.3s ease; overflow: hidden; }
    .modal-backdrop.show .modal-content { transform: scale(1); opacity: 1; }
    .modal-header { background: var(--primary); color: white; padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; }
    .modal-title { font-size: 1.1rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 10px;}
    .modal-close { background: none; border: none; font-size: 1.5rem; color: rgba(255,255,255,0.7); cursor: pointer; line-height: 1; }
    .modal-close:hover { color: white; }
    .modal-body { padding: 24px; }
    .modal-footer { display: flex; justify-content: flex-end; gap: 12px; padding: 20px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; }

    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--text-main); margin-bottom: 8px; }
    .form-control { width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #cbd5e1; font-family: inherit; font-size: 0.95rem; outline: none; }
    .form-control:focus { border-color: var(--primary); }

    .btn-primary { background: var(--primary); color: white; }
    .btn-outline { background: white; border: 1px solid #cbd5e1; color: var(--text-main); }
</style>

<div class="page-header">
    <div class="header-content">
        <h1 class="header-title">
            <i data-lucide="building" style="width: 32px; height: 32px; color: #fbbf24;"></i>
            Data Sekolah
        </h1>
        <p class="header-subtitle">Pantau daftar sekolah yang terdaftar di seluruh wilayah</p>
    </div>
    <div class="header-actions">
        <button onclick="openModal('modalSekolah')" class="btn btn-warning">
            <i data-lucide="plus" style="width: 18px;"></i> Tambah Sekolah Baru
        </button>
    </div>
</div>

@if(session('success'))
<div class="alert-success">
    <i data-lucide="check-circle" style="width: 20px;"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

<div class="dashboard-grid">
    <div class="stat-card">
        <span class="stat-label">Total Sekolah</span>
        <span class="stat-value">{{ $schools->count() }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Total Siswa</span>
        <span class="stat-value">{{ number_format($schools->sum('jumlah_siswa')) }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Siswa Terlayani</span>
        <span class="stat-value" style="color: #10b981;">{{ number_format($schools->sum('jumlah_terlayani')) }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Status Pelayanan</span>
        <span class="stat-value" style="color: #f59e0b;">{{ $schools->where('status_jempol', 'Dijadwalkan')->count() }} <span style="font-size: 1rem; color: var(--text-muted); font-weight: 600;">Dijadwalkan</span></span>
    </div>
</div>

<div class="panel-box">
    <div class="search-container">
        <form action="{{ route('admin.sekolah') }}" method="GET" class="search-form">
            <i data-lucide="search" style="color: var(--text-muted); width: 20px;"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama sekolah atau kecamatan..." class="search-input">
            @if(request('search'))
                <a href="{{ route('admin.sekolah') }}" style="color: var(--text-muted);"><i data-lucide="x" style="width: 20px;"></i></a>
            @endif
        </form>
        @if(request('search'))
            <div style="font-size: 0.9rem; color: var(--text-muted);">
                Menampilkan hasil untuk: <strong>"{{ request('search') }}"</strong>
            </div>
        @endif
    </div>

    <div style="overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Sekolah</th>
                    <th>Kecamatan</th>
                    <th>Jml. Siswa</th>
                    <th>Terlayani</th>
                    <th>Jempol</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schools as $i => $school)
                <tr>
                    <td style="font-weight: 600; color: var(--text-muted);">{{ $i + 1 }}</td>
                    <td>
                        <div class="school-info">
                            <span class="school-name">{{ $school->nama_sekolah }}</span>
                            <div style="display: flex; gap: 8px;">
                                <span class="badge badge-primary">{{ $school->tingkat }}</span>
                                <span class="badge badge-neutral">{{ $school->status ?? 'Swasta' }}</span>
                            </div>
                        </div>
                    </td>
                    <td style="font-weight: 600; color: var(--text-main);">{{ $school->kecamatan }}</td>
                    <td><span style="font-weight: 700; color: var(--text-main);">{{ number_format($school->jumlah_siswa) }}</span> <span style="font-size: 0.8rem; color: var(--text-muted);">siswa</span></td>
                    <td><span style="font-weight: 700; color: #10b981;">{{ number_format($school->jumlah_terlayani ?? 0) }}</span> <span style="font-size: 0.8rem; color: var(--text-muted);">siswa</span></td>
                    <td>
                        @if($school->status_jempol == 'Sudah')
                            <span class="badge badge-success"><i data-lucide="check" style="width: 12px; display: inline-block;"></i> Selesai</span>
                        @elseif($school->status_jempol == 'Dijadwalkan')
                            <span class="badge badge-warning">Dijadwalkan</span>
                        @else
                            <span class="badge badge-neutral">Belum</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                            <button onclick="openEditModal({{ $school->id }}, '{{ addslashes($school->nama_sekolah) }}', {{ $school->jumlah_siswa }})" class="action-btn edit" title="Edit Jumlah Siswa">
                                <i data-lucide="edit-2" style="width: 16px;"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 32px; color: var(--text-muted);">Belum ada data sekolah terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Sekolah -->
<div id="modalSekolah" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i data-lucide="plus-circle" style="width: 20px;"></i> Tambah Sekolah</h3>
            <button type="button" class="modal-close" onclick="closeModal('modalSekolah')">&times;</button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.sekolah.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Pilih Tingkat</label>
                    <select id="sekolah_level" name="tingkat" required class="form-control" onchange="populateSchoolsInModal()">
                        <option value="" disabled selected>-- Pilih Tingkat --</option>
                        <option value="TK">TK</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SLTA">SLTA</option>
                    </select>
                </div>
                <div class="form-group" id="sekolah_kecamatan_group" style="display: none;">
                    <label>Pilih Kecamatan</label>
                    <select id="sekolah_kecamatan" name="kecamatan" required class="form-control" onchange="populateSchoolsInModal()">
                        <option value="" disabled selected>-- Pilih Kecamatan --</option>
                        <option value="Kota Tegal">Kota Tegal</option>
                        <option value="Margadana">Kecamatan Margadana</option>
                        <option value="Tegal Barat">Kecamatan Tegal Barat</option>
                        <option value="Tegal Selatan">Kecamatan Tegal Selatan</option>
                        <option value="Tegal Timur">Kecamatan Tegal Timur</option>
                    </select>
                </div>
                <div class="form-group" id="school_list_group" style="display: none;">
                    <label>Nama Sekolah</label>
                    <select id="school_select" name="nama_sekolah" required class="form-control">
                        <option value="" disabled selected>-- Pilih Sekolah --</option>
                    </select>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label>Jumlah Siswa (Estimasi)</label>
                        <input type="number" name="jumlah_siswa" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status Sekolah</label>
                        <select name="status" class="form-control">
                            <option value="Swasta" selected>Swasta</option>
                            <option value="Negeri">Negeri</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 0; background: none; border: none; margin-top: 10px;">
                    <button type="button" class="btn btn-outline" onclick="closeModal('modalSekolah')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Jumlah Siswa -->
<div id="modalEditSiswa" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i data-lucide="edit-2" style="width: 20px;"></i> Update Jumlah Siswa</h3>
            <button type="button" class="modal-close" onclick="closeModal('modalEditSiswa')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="formEditSiswa" method="POST">
                @csrf
                <input type="hidden" name="id" id="editSchoolId">
                <div style="margin-bottom: 20px;">
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 4px;">Memperbarui data siswa untuk:</p>
                    <p id="editNamaSekolah" style="font-size: 1.1rem; font-weight: 800; color: var(--primary); margin: 0;"></p>
                </div>
                <div class="form-group">
                    <label>Jumlah Siswa Terbaru</label>
                    <input type="number" name="jumlah_siswa" id="editJumlahSiswa" required class="form-control" style="font-size: 1.2rem; font-weight: 700;">
                </div>
                <div class="modal-footer" style="padding: 0; background: none; border: none; margin-top: 10px;">
                    <button type="button" class="btn btn-outline" onclick="closeModal('modalEditSiswa')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(id) { 
        document.getElementById(id).classList.add('show'); 
        document.body.style.overflow = 'hidden'; 
    }
    function closeModal(id) { 
        document.getElementById(id).classList.remove('show'); 
        document.body.style.overflow = 'auto'; 
    }

    function openEditModal(id, nama, jumlah) {
        const form = document.getElementById('formEditSiswa');
        const nameEl = document.getElementById('editNamaSekolah');
        const inputEl = document.getElementById('editJumlahSiswa');
        
        form.action = `/admin/sekolah/${id}/update-siswa`;
        nameEl.innerText = nama;
        inputEl.value = jumlah;
        
        openModal('modalEditSiswa');
    }

    const schoolData = {
        tk: {
            "Margadana": [
                { value: 'tk_margadana_1', text: 'TK NEGERI PEMBINA KECAMATAN MARGADANA' },
                { value: 'tk_margadana_2', text: 'TK AISYIYAH BUSTANUL ATHFAL X' },
                { value: 'tk_margadana_3', text: 'TK MASYITHOH VII' },
                { value: 'tk_margadana_4', text: 'TK PERTIWI 25.12 KALINYAMAT KULON' },
                { value: 'tk_margadana_5', text: 'TK TARBIYATUL ISLAMIYAH' },
                { value: 'tk_margadana_6', text: 'TK PERTIWI KRANDON' },
                { value: 'tk_margadana_7', text: 'TK PERTIWI CABAWAN' },
                { value: 'tk_aba_sumurpanggang', text: 'TK ABA SUMURPANGGANG' }
            ],
            "Tegal Barat": [
                { value: 'tk_tegalbarat_1', text: 'TK AISYIYAH BUSTANUL ATHFAL VIII' },
                { value: 'tk_tegalbarat_2', text: 'TK AL KHAIRIYYAH' },
                { value: 'tk_tegalbarat_3', text: 'TK AL-IRSYAD AL-ISLAMIYAH' },
                { value: 'tk_tegalbarat_4', text: 'TK ASSYIFA' },
                { value: 'tk_tegalbarat_5', text: 'TK BAGYA WACANA' },
                { value: 'tk_tegalbarat_6', text: 'TK ELKANA' },
                { value: 'tk_tegalbarat_7', text: 'TK GLOBAL INBYRA SCHOOL' },
                { value: 'tk_tegalbarat_8', text: 'TK HANG TUAH 16' },
                { value: 'tk_tegalbarat_9', text: 'TK LITTLE STAR' },
                { value: 'tk_tegalbarat_10', text: 'TK PERTIWI 25.5 KRATON' },
                { value: 'tk_tegalbarat_11', text: 'TK PIUS' }
            ],
            "Tegal Selatan": [
                { value: 'tk_tegal_selatan_1', text: 'TK AISYIYAH BUSTANUL ATHFAL II' },
                { value: 'tk_tegal_selatan_2', text: 'TK AISYIYAH BUSTANUL ATHFAL XIII' },
                { value: 'tk_tegal_selatan_3', text: 'TK MASYITHOH I' },
                { value: 'tk_tegal_selatan_4', text: 'TK MASYITHOH V' },
                { value: 'tk_tegal_selatan_5', text: 'TK PERTIWI 25.1 RANDUGUNTING' },
                { value: 'tk_tegal_selatan_6', text: 'TK PERTIWI 25.9 BANDUNG' },
                { value: 'tk_tegal_selatan_7', text: 'TK BIAS ASSALAM' },
                { value: 'tk_tegal_selatan_8', text: 'TK BAITUSH SHOBIRIN' }
            ],
            "Tegal Timur": [
                { value: 'tk_tegal_timur_1', text: 'TK AISYIYAH I' },
                { value: 'tk_tegal_timur_2', text: 'TK AISYIYAH III' },
                { value: 'tk_tegal_timur_3', text: 'TK AISYIYAH VII' },
                { value: 'tk_tegal_timur_4', text: 'TK AISYIYAH IX' },
                { value: 'tk_tegal_timur_5', text: 'TK MASYITHOH II' },
                { value: 'tk_tegal_timur_6', text: 'TK MASYITHOH III' },
                { value: 'tk_tegal_timur_7', text: 'TK PERTIWI 25.13 KEJAMBON' },
                { value: 'tk_tegal_timur_8', text: 'TK PERTIWI 25.3 SLEROK' },
                { value: 'tk_tegal_timur_9', text: 'TK NEGERI PEMBINA KOTA TEGAL' }
            ]
        },
        sd: {
            "Margadana": [
                { value: 'sd_margadana_1', text: 'SD NEGERI MARGADANA 1' },
                { value: 'sd_margadana_2', text: 'SD NEGERI KALINYAMAT KULON 1' },
                { value: 'sd_margadana_3', text: 'SD NEGERI SUMURPANGGANG 1' }
            ],
            "Tegal Barat": [
                { value: 'sd_tegalbarat_1', text: 'SD NEGERI KRATON 1' },
                { value: 'sd_tegalbarat_2', text: 'SD NEGERI PEKAUMAN 1' },
                { value: 'sd_tegalbarat_3', text: 'SD PIUS TEGAL' }
            ],
            "Tegal Selatan": [
                { value: 'sd_tegal_selatan_1', text: 'SD NEGERI RANDUGUNTING 1' },
                { value: 'sd_tegal_selatan_2', text: 'SD NEGERI TUNON 1' },
                { value: 'sd_tegal_selatan_3', text: 'SD MUHAMMADIYAH TEGAL' }
            ],
            "Tegal Timur": [
                { value: 'sd_tegal_timur_1', text: 'SD NEGERI KEJAMBON 1' },
                { value: 'sd_tegal_timur_2', text: 'SD NEGERI SLEROK 1' },
                { value: 'sd_tegal_timur_3', text: 'SD AL IRSYAD TEGAL' }
            ]
        },
        smp: {
            "Kota Tegal": [
                { value: 'smp_1', text: 'SMP NEGERI 1 TEGAL' },
                { value: 'smp_2', text: 'SMP NEGERI 2 TEGAL' },
                { value: 'smp_3', text: 'SMP NEGERI 3 TEGAL' },
                { value: 'smp_4', text: 'SMP NEGERI 4 TEGAL' },
                { value: 'smp_5', text: 'SMP ISLAM AL IRSYAD TEGAL' },
                { value: 'smp_6', text: 'SMP PIUS TEGAL' }
            ]
        },
        slta: {
            "Kota Tegal": [
                { value: 'slta_1', text: 'SMAN 1 TEGAL' },
                { value: 'slta_2', text: 'SMAN 2 TEGAL' },
                { value: 'slta_3', text: 'SMAN 3 TEGAL' },
                { value: 'slta_4', text: 'SMKN 1 TEGAL' },
                { value: 'slta_5', text: 'SMKN 2 TEGAL' },
                { value: 'slta_6', text: 'SMK HARAPAN BERSAMA TEGAL' },
                { value: 'slta_7', text: 'SMA AL IRSYAD TEGAL' }
            ]
        }
    };

    function populateSchoolsInModal() {
        const levelSelect = document.getElementById('sekolah_level');
        const kecSelect = document.getElementById('sekolah_kecamatan');
        const schoolSelect = document.getElementById('school_select');
        const kecGroup = document.getElementById('sekolah_kecamatan_group');
        const schoolListGroup = document.getElementById('school_list_group');
        
        if (!levelSelect || !kecSelect || !schoolSelect) return;

        const level = levelSelect.value.toLowerCase();
        const kec = kecSelect.value;

        schoolSelect.innerHTML = '<option value="" disabled selected>-- Pilih Sekolah --</option>';

        if (!level) {
            kecGroup.style.display = 'none';
            schoolListGroup.style.display = 'none';
            return;
        }

        kecGroup.style.display = 'block';

        let schoolsToPopulate = [];

        if (kec && schoolData[level]) {
            if (schoolData[level][kec]) {
                schoolsToPopulate = schoolData[level][kec];
            } else {
                if (schoolData[level]["Kota Tegal"]) {
                    schoolsToPopulate = schoolData[level]["Kota Tegal"];
                } else if (kec === 'Kota Tegal') {
                    Object.keys(schoolData[level]).forEach(k => {
                        if (Array.isArray(schoolData[level][k])) {
                            schoolsToPopulate = schoolsToPopulate.concat(schoolData[level][k]);
                        }
                    });
                }
            }
        }

        if (schoolsToPopulate.length > 0) {
            schoolsToPopulate.forEach(s => {
                const opt = document.createElement('option');
                opt.value = s.text;
                opt.textContent = s.text;
                schoolSelect.appendChild(opt);
            });
            schoolListGroup.style.display = 'block';
        } else {
            schoolListGroup.style.display = 'none';
        }
    }
</script>
@endsection
