@extends('layouts.panel')

@section('title', 'Pengaturan Pengguna - Settings')

@section('content')
<style>
    .settings-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        color: white;
        padding: 40px;
        position: relative;
        overflow: hidden;
        margin: -2rem -2rem 30px -2rem;
        box-shadow: 0 10px 25px -5px rgba(0, 49, 120, 0.3);
        border-bottom: 6px solid #fbbf24;
    }
    .settings-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url('{{ asset("images/batik-tegal-premium.jpg") }}');
        background-size: 400px;
        opacity: 0.12;
        mix-blend-mode: luminosity;
    }
    .settings-container {
        display: block;
    }
    .settings-sidebar {
        background: white;
        border-radius: 24px;
        box-shadow: 0 4px 20px -5px rgba(0,0,0,0.05);
        padding: 12px;
    }
    .settings-item {
        display: flex;
        align-items: center;
        padding: 16px;
        border-radius: 16px;
        transition: all 0.2s;
        text-decoration: none;
        color: var(--text-main);
        margin-bottom: 8px;
    }
    .settings-item:last-child { margin-bottom: 0; }
    .settings-item:hover, .settings-item.active { background: #f8fafc; }
    .settings-item.active { background: #eff6ff; color: #2563eb; }
    .settings-icon {
        width: 40px; height: 40px; border-radius: 12px;
        background: #eff6ff; color: #2563eb;
        display: grid; place-items: center;
        margin-right: 16px; flex-shrink: 0;
    }
    .settings-item.active .settings-icon { background: #2563eb; color: white; }
    .settings-text h3 { margin: 0 0 4px; font-size: 0.95rem; font-weight: 700; }
    .settings-text p { margin: 0; font-size: 0.8rem; color: var(--text-muted); }
    .settings-content-card {
        background: white; border-radius: 24px;
        box-shadow: 0 4px 20px -5px rgba(0,0,0,0.05); padding: 32px;
    }
    .btn-primary {
        background: var(--primary); color: white; padding: 12px 24px;
        border-radius: 12px; font-weight: 700; border: none; cursor: pointer;
        display: flex; align-items: center; gap: 8px; transition: all 0.2s;
    }
    .btn-primary:hover { background: #002255; transform: translateY(-2px); }
    
    .table-container { overflow-x: auto; border-radius: 16px; border: 1px solid #f1f5f9; }
    .custom-table { width: 100%; border-collapse: collapse; }
    .custom-table th {
        background: #f8fafc; padding: 16px 20px; text-align: left;
        font-size: 0.85rem; font-weight: 700; color: var(--text-muted);
        text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0;
    }
    .custom-table td { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .custom-table tbody tr:hover { background: #f8fafc; }
    .badge-primary { background: #eff6ff; color: #2563eb; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
    .action-btn { width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: all 0.2s; }
    .action-btn.edit { background: #eff6ff; color: #3b82f6; }
    .action-btn.edit:hover { background: #3b82f6; color: white; }
    .action-btn.delete { background: #fef2f2; color: #ef4444; }
    .action-btn.delete:hover { background: #ef4444; color: white; }
    
    .modal-overlay {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(4px); z-index: 100;
        display: flex; align-items: center; justify-content: center; padding: 20px;
    }
    .modal-container {
        background: white; border-radius: 24px; width: 100%; max-width: 600px;
        max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .modal-header { padding: 24px 32px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; background: white; z-index: 10; }
    .modal-body { padding: 32px; }
    .modal-footer { padding: 24px 32px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 12px; position: sticky; bottom: 0; background: white; z-index: 10; }
    
    .form-group { margin-bottom: 24px; }
    .form-label { display: block; font-weight: 700; margin-bottom: 8px; color: var(--text-main); }
    .form-input { width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 0.95rem; transition: all 0.2s; background: #f8fafc; }
    .form-input:focus { border-color: #3b82f6; outline: none; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); background: white; }
</style>



<div class="settings-container" x-data="{ 
    showAddModal: false, 
    showEditModal: false, 
    editData: null,
    showPasswordPrompt: false,
    targetEditData: null,
    inputPassword: '',
    passwordError: false,
    async verifyPassword() {
        this.passwordError = false;
        try {
            const res = await fetch('{{ route('admin.verify-password') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ password: this.inputPassword })
            });
            const data = await res.json();
            if (res.ok && data.success) {
                this.showPasswordPrompt = false;
                this.editData = this.targetEditData;
                this.inputPassword = '';
                this.showEditModal = true;
            } else {
                this.passwordError = true;
            }
        } catch (e) {
            this.passwordError = true;
        }
    }
}">

    <div class="settings-content-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <div>
                <h2 style="margin: 0 0 4px; font-size: 1.25rem; font-weight: 800;">Daftar Pengguna</h2>
                <p style="margin: 0; color: var(--text-muted); font-size: 0.9rem;">Kelola admin dan petugas cabang.</p>
            </div>
            <button @click="showAddModal = true" class="btn-primary">
                <i data-lucide="plus" style="width: 18px; height: 18px;"></i> Tambah Pengguna
            </button>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama & NIK</th>
                        <th>Email / Username</th>
                        <th>Peran (Role)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td style="color: var(--text-muted); font-weight: 600;">{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight: 700; color: var(--text-main);">{{ $user->name }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $user->nik ?? '-' }}</div>
                        </td>
                        <td>
                            <div style="color: var(--text-main);">{{ $user->email }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $user->username ?? '-' }}</div>
                        </td>
                        <td>
                            <span class="badge-primary">{{ $user->role ?? 'User' }}</span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <button @click='targetEditData = @json($user); showPasswordPrompt = true; inputPassword = ""; passwordError = false;' class="action-btn edit" title="Edit">
                                    <i data-lucide="edit-2" style="width: 16px; height: 16px;"></i>
                                </button>
                                <form action="{{ route('admin.master-data.petugas.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete" title="Hapus">
                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-muted);">
                            <i data-lucide="users" style="width: 48px; height: 48px; opacity: 0.5; margin-bottom: 12px;"></i>
                            <p style="margin: 0; font-weight: 600;">Belum ada data pengguna</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div x-show="showAddModal" style="display: none;" class="modal-overlay" x-transition.opacity>
        <div class="modal-container" @click.away="showAddModal = false">
            <div class="modal-header">
                <h3 style="margin: 0; font-size: 1.25rem; font-weight: 800;">Tambah Pengguna Baru</h3>
                <button @click="showAddModal = false" style="background: transparent; border: none; cursor: pointer; color: var(--text-muted);">
                    <i data-lucide="x"></i>
                </button>
            </div>
            <form action="{{ route('admin.master-data.petugas.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="form-group">
                            <label class="form-label">NIK</label>
                            <input type="text" name="nik" class="form-input" placeholder="16 Digit NIK" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-input" placeholder="Budi Santoso" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Foto Profil <span style="font-weight: 400; color: var(--text-muted); font-size: 0.8rem;">(Opsional)</span></label>
                        <input type="file" name="foto_profil" accept="image/*" class="form-input" style="padding: 9px 16px;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email / Username</label>
                        <input type="text" name="email" class="form-input" placeholder="email@contoh.com" required>
                    </div>
                    <div class="form-group" x-data="{ showPw: false }">
                        <label class="form-label">Password</label>
                        <div style="position: relative;">
                            <input :type="showPw ? 'text' : 'password'" name="password" class="form-input" placeholder="Minimal 8 karakter" required>
                            <button type="button" @click="showPw = !showPw" style="position: absolute; right: 16px; top: 14px; background: none; border: none; cursor: pointer; color: var(--text-muted);">
                                <i data-lucide="eye" x-show="!showPw" style="width: 18px; height: 18px;"></i>
                                <i data-lucide="eye-off" x-show="showPw" style="width: 18px; height: 18px; display: none;"></i>
                            </button>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="form-group">
                            <label class="form-label">Peran (Role)</label>
                            <select name="role" class="form-input" required>
                                <option value="">-- Pilih Peran --</option>
                                <option value="petugas capil">Petugas Capil</option>
                                <option value="cabang dinas">Cabang Dinas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Wilayah</label>
                            <input type="text" name="wilayah" class="form-input" placeholder="Contoh: Kejaksan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="showAddModal = false" style="background: #f1f5f9; color: var(--text-main); padding: 12px 24px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer;">Batal</button>
                    <button type="submit" class="btn-primary">Simpan Pengguna</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Password Prompt Modal -->
    <div x-show="showPasswordPrompt" style="display: none;" class="modal-overlay" x-transition.opacity>
        <div class="modal-container" @click.away="showPasswordPrompt = false" style="max-width: 400px;">
            <div class="modal-header">
                <h3 style="margin: 0; font-size: 1.25rem; font-weight: 800; display: flex; align-items: center;"><i data-lucide="lock" style="width: 20px; color: var(--primary); margin-right: 8px;"></i>Konfirmasi Keamanan</h3>
                <button @click="showPasswordPrompt = false" style="background: transparent; border: none; cursor: pointer; color: var(--text-muted);">
                    <i data-lucide="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p style="margin-bottom: 16px; color: var(--text-muted); font-size: 0.95rem;">Silakan masukkan password akun Anda untuk melanjutkan proses pengeditan.</p>
                <div class="form-group" style="margin-bottom: 0;">
                    <input type="password" x-model="inputPassword" class="form-input" placeholder="Masukkan password Anda" @keyup.enter="verifyPassword()">
                    <p x-show="passwordError" style="color: #ef4444; font-size: 0.85rem; margin-top: 8px; font-weight: 500;">
                        <i data-lucide="alert-circle" style="width: 14px; display: inline-block; vertical-align: middle;"></i> Password salah!
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" @click="showPasswordPrompt = false" style="background: #f1f5f9; color: var(--text-main); padding: 10px 20px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer;">Batal</button>
                <button type="button" @click="verifyPassword()" class="btn-primary" style="padding: 10px 20px;">Lanjut</button>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="showEditModal" style="display: none;" class="modal-overlay" x-transition.opacity>
        <div class="modal-container" @click.away="showEditModal = false">
            <div class="modal-header">
                <h3 style="margin: 0; font-size: 1.25rem; font-weight: 800;">Edit Pengguna</h3>
                <button @click="showEditModal = false" style="background: transparent; border: none; cursor: pointer; color: var(--text-muted);">
                    <i data-lucide="x"></i>
                </button>
            </div>
            <form :action="`/admin/master-data/petugas/${editData?.id}`" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf @method('PUT')
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="form-group">
                            <label class="form-label">NIK</label>
                            <input type="text" name="nik" :value="editData?.nik" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" :value="editData?.name" class="form-input" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Foto Profil <span style="font-weight: 400; color: var(--text-muted); font-size: 0.8rem;">(Opsional)</span></label>
                        <input type="file" name="foto_profil" accept="image/*" class="form-input" style="padding: 9px 16px;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email / Username</label>
                        <input type="text" name="email" :value="editData?.email" class="form-input" required>
                    </div>
                    <div class="form-group" x-data="{ showPwEdit: false }">
                        <label class="form-label">Password Baru <span style="font-weight: 400; color: var(--text-muted); font-size: 0.8rem;">(Opsional)</span></label>
                        <div style="position: relative;">
                            <input :type="showPwEdit ? 'text' : 'password'" name="password" class="form-input">
                            <button type="button" @click="showPwEdit = !showPwEdit" style="position: absolute; right: 16px; top: 14px; background: none; border: none; cursor: pointer; color: var(--text-muted);">
                                <i data-lucide="eye" x-show="!showPwEdit" style="width: 18px; height: 18px;"></i>
                                <i data-lucide="eye-off" x-show="showPwEdit" style="width: 18px; height: 18px; display: none;"></i>
                            </button>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="form-group">
                            <label class="form-label">Peran (Role)</label>
                            <select name="role" class="form-input" required>
                                <option value="petugas capil" :selected="editData?.role === 'petugas capil'">Petugas Capil</option>
                                <option value="cabang dinas" :selected="editData?.role === 'cabang dinas'">Cabang Dinas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Wilayah</label>
                            <input type="text" name="wilayah" :value="editData?.kecamatan" class="form-input">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="showEditModal = false" style="background: #f1f5f9; color: var(--text-main); padding: 12px 24px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer;">Batal</button>
                    <button type="submit" class="btn-primary">Update Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
