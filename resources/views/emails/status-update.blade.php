<!DOCTYPE html>
<html>
<head>
    <title>Pembaruan Status Pengajuan</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; background-color: #f8fafc; padding: 20px; }
        .container { max-w-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .header { background: #0f172a; padding: 30px; text-align: center; color: white; }
        .content { padding: 30px; }
        .status-box { background: #f1f5f9; padding: 15px; border-radius: 8px; text-align: center; font-size: 20px; font-weight: bold; color: #0f172a; margin: 20px 0; border: 2px dashed #cbd5e1; text-transform: uppercase; }
        
        .status-selesai { border-color: #10b981; color: #10b981; background: #ecfdf5; }
        .status-diproses { border-color: #3b82f6; color: #3b82f6; background: #eff6ff; }
        .status-ditolak { border-color: #ef4444; color: #ef4444; background: #fef2f2; }

        .details { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .details th, .details td { text-align: left; padding: 10px; border-bottom: 1px solid #e2e8f0; }
        .details th { color: #64748b; font-weight: 600; width: 40%; }
        .footer { background: #f8fafc; text-align: center; padding: 20px; font-size: 12px; color: #64748b; border-top: 1px solid #e2e8f0; }
        .btn { display: inline-block; padding: 12px 24px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="jbl-186">
        <div class="header">
            <h2 style="margin: 0;">Pembaruan Status Pengajuan</h2>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $user->name }}</strong>.</p>
            <p>Status pengajuan layanan administrasi Anda dengan nomor tiket <strong>{{ $permohonan->nomor_tiket }}</strong> telah diperbarui.</p>
            
            @php
                $statusClass = '';
                if($permohonan->status == 'selesai') $statusClass = 'status-selesai';
                if($permohonan->status == 'diproses') $statusClass = 'status-diproses';
                if($permohonan->status == 'ditolak') $statusClass = 'status-ditolak';
            @endphp

            <div class="status-box {{ $statusClass }}">
                {{ $permohonan->status }}
            </div>

            <table class="details">
                <tr>
                    <th>Jenis Layanan</th>
                    <td>{{ $permohonan->jenis_layanan }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kedatangan</th>
                    <td>{{ date('d F Y', strtotime($permohonan->tanggal_kedatangan)) }}</td>
                </tr>
                @if($permohonan->keterangan)
                <tr>
                    <th>Catatan Petugas</th>
                    <td>{{ $permohonan->keterangan }}</td>
                </tr>
                @endif
            </table>

            <div style="text-align: center;">
                <a href="{{ url('/') }}" class="btn">Lihat Detail Lengkap</a>
            </div>
        </div>
        <div class="footer">
            Email ini dikirimkan secara otomatis oleh Sistem JEBOL. Mohon untuk tidak membalas email ini.
        </div>
    </div>
</body>
</html>

