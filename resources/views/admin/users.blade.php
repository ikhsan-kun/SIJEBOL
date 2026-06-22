@extends('layouts.panel')

@section('title', 'Manajemen Pengguna - SI JEBOL Admin')

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
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card.active { border-color: var(--primary); box-shadow: 0 0 0 1px var(--primary); }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -8px rgba(0,0,0,0.08);
        border-color: #e2e8f0;
    }
    
    .stat-bg-icon {
        position: absolute;
        right: -10px;
        bottom: -10px;
        width: 100px;
        height: 100px;
        opacity: 0.05;
        color: var(--primary);
    }

    .stat-label { font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
    .stat-value { font-size: 2.2rem; font-weight: 800; color: var(--text-main); line-height: 1; margin-bottom: 4px; }
    .stat-sub { font-size: 0.8rem; color: var(--text-muted); }

    .panel-box {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
        margin-bottom: 24px;
    }

    .filter-tabs {
        display: flex;
        gap: 24px;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 24px;
    }
    
    .filter-tab {
        padding: 0 0 12px 0;
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--text-muted);
        text-decoration: none;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
    }
    
    .filter-tab:hover { color: var(--text-main); border-bottom-color: #cbd5e1; }
    .filter-tab.active { color: var(--primary); border-bottom-color: var(--primary); }

    /* Data Table */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .data-table th, .data-table td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        vertical-align: middle;
    }
    
    .data-table th {
        background: #f8fafc;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.8rem;
        text-align: left;
    }

    .data-table th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .data-table th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

    .data-table tr { transition: background 0.2s; }
    .data-table tbody tr:hover { background: #f8fafc; }

    .user-info { display: flex; align-items: center; gap: 12px; }
    .user-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
    .user-name { font-weight: 700; color: var(--text-main); font-size: 0.95rem; }
    .user-email { font-size: 0.8rem; color: var(--text-muted); }

    .role-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .role-admin { background: #dbeafe; color: #1d4ed8; }
    .role-cabang { background: #fef3c7; color: #d97706; }
    .role-user { background: #d1fae5; color: #047857; }

    .status-indicator { display: flex; align-items: center; gap: 6px; font-weight: 600; font-size: 0.85rem; }
    .status-dot { width: 8px; height: 8px; border-radius: 50%; }
    .status-aktif .status-dot { background: #10b981; }
    .status-non-aktif .status-dot { background: #94a3b8; }
    .status-aktif { color: #10b981; }
    .status-non-aktif { color: #94a3b8; }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-grid;
        place-items: center;
        color: var(--text-muted);
        background: #f1f5f9;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    
    .action-btn:hover { background: #e2e8f0; color: var(--text-main); }
    .action-btn.delete:hover { background: #fee2e2; color: #dc2626; }

    .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-weight: 500; }
</style>

<div class="page-header">
    <div class="header-content">
        <h1 class="header-title">
            <i data-lucide="users" style="width: 32px; height: 32px; color: #fbbf24;"></i>
            Manajemen Pengguna
        </h1>
        <p class="header-subtitle">SI JEBOL / Administrasi Sistem / Database</p>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.users.create') }}" class="btn btn-warning">
            <i data-lucide="user-plus" style="width: 18px;"></i> Tambah Pengguna
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert-success">
    <i data-lucide="check-circle" style="width: 20px;"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

<div class="dashboard-grid">
    <a href="{{ route('admin.users', ['role' => 'all']) }}" class="stat-card {{ !request('role') || request('role') == 'all' ? 'active' : '' }}">
        <i data-lucide="users" class="stat-bg-icon"></i>
        <span class="stat-label">Total Keseluruhan</span>
        <span class="stat-value">{{ $totalCount }}</span>
        <span class="stat-sub">Total Seluruh User</span>
    </a>
    
    <a href="{{ route('admin.users', ['role' => 'admin']) }}" class="stat-card {{ request('role') == 'admin' ? 'active' : '' }}">
        <i data-lucide="shield-check" class="stat-bg-icon"></i>
        <span class="stat-label">Admin</span>
        <span class="stat-value">{{ $adminCount }}</span>
        <span class="stat-sub">Administrator Pusat</span>
    </a>
    
    <a href="{{ route('admin.users', ['role' => 'cabang']) }}" class="stat-card {{ request('role') == 'cabang' ? 'active' : '' }}">
        <i data-lucide="building" class="stat-bg-icon"></i>
        <span class="stat-label">Cabang Dinas</span>
        <span class="stat-value">{{ sprintf('%02d', $petugasCount) }}</span>
        <span class="stat-sub">UPT Disdukcapil</span>
    </a>
    
    <a href="{{ route('admin.users', ['role' => 'user']) }}" class="stat-card {{ request('role') == 'user' ? 'active' : '' }}">
        <i data-lucide="map-pin" class="stat-bg-icon"></i>
        <span class="stat-label">Kelurahan / Instansi</span>
        <span class="stat-value">{{ $citizenCount }}</span>
        <span class="stat-sub">Cabang Instansi</span>
    </a>
</div>

<div class="panel-box">
    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div class="filter-tabs">
            <a href="{{ route('admin.users', ['role' => 'all']) }}" class="filter-tab {{ !request('role') || request('role') == 'all' ? 'active' : '' }}">Semua Role</a>
            <a href="{{ route('admin.users', ['status' => 'aktif']) }}" class="filter-tab {{ request('status') == 'aktif' ? 'active' : '' }}">Aktif</a>
            <a href="{{ route('admin.users', ['status' => 'non-aktif']) }}" class="filter-tab {{ request('status') == 'non-aktif' ? 'active' : '' }}">Non-aktif</a>
        </div>
        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600; padding-bottom: 12px;">Total {{ $totalCount }} user terdaftar</div>
    </div>

    <div style="overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama User</th>
                    <th>Role / Kategori</th>
                    <th>Unit Kerja</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td>
                        <div class="user-info">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($u->name) }}&background={{ $u->role === 'admin' ? '003178' : ($u->role === 'cabang' ? 'f59e0b' : '10b981') }}&color=fff&bold=true" alt="Avatar" class="user-avatar">
                            <div>
                                <div class="user-name">{{ $u->name }}</div>
                                <div class="user-email">{{ $u->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php
                            $roleClass = 'role-user';
                            if($u->role === 'admin') $roleClass = 'role-admin';
                            elseif($u->role === 'cabang') $roleClass = 'role-cabang';
                        @endphp
                        <span class="role-badge {{ $roleClass }}">{{ $u->role ?: 'Masyarakat' }}</span>
                    </td>
                    <td style="font-weight: 600; color: var(--text-main);">
                        {{ $u->kecamatan ?? 'Pusat' }}
                    </td>
                    <td>
                        @php
                            $status = strtolower($u->status ?? 'aktif');
                            $statusClass = $status === 'aktif' ? 'status-aktif' : 'status-non-aktif';
                        @endphp
                        <div class="status-indicator {{ $statusClass }}">
                            <div class="status-dot"></div>
                            {{ ucfirst($status) }}
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                            <a href="{{ route('admin.users.edit', $u->id) }}" class="action-btn" title="Edit User">
                                <i data-lucide="edit-2" style="width: 16px;"></i>
                            </a>
                            <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Semua data terkait akan hilang.')" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete" title="Hapus User">
                                    <i data-lucide="trash-2" style="width: 16px;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 32px; color: var(--text-muted);">
                        Belum ada data pengguna yang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($users, 'links'))
    <div style="margin-top: 24px;">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
