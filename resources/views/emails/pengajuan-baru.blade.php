<!DOCTYPE html>
<html>
<head>
    <title>Tiket Pengajuan Baru</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; background-color: #f8fafc; padding: 20px; }
        .container { max-w-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .header { background: #0f172a; padding: 30px; text-align: center; color: white; }
        .content { padding: 30px; }
        .ticket-box { background: #f1f5f9; padding: 15px; border-radius: 8px; text-align: center; font-size: 24px; font-weight: bold; letter-spacing: 2px; color: #0f172a; margin: 20px 0; border: 2px dashed #cbd5e1; }
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
            <h2 style="margin: 0;">Pengajuan Layanan Berhasil</h2>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $user->name }}</strong>.</p>
            <p>Terima kasih telah melakukan pengajuan layanan administrasi kependudukan. Berikut adalah nomor tiket pengajuan Anda:</p>
            
            <div class="ticket-box">
                {{ $permohonan->nomor_tiket }}
            </div>

            <p>Mohon simpan nomor tiket ini dengan baik untuk keperluan pengecekan status.</p>

            <table class="details">
                <tr>
                    <th>Jenis Layanan</th>
                    <td>{{ $permohonan->jenis_layanan }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kedatangan</th>
                    <td>{{ date('d F Y', strtotime($permohonan->tanggal_kedatangan)) }}</td>
                </tr>
                <tr>
                    <th>Status Saat Ini</th>
                    <td><span style="color: #f59e0b; font-weight: bold;">Pending</span></td>
                </tr>
            </table>

            <div style="text-align: center;">
                <a href="{{ url('/') }}" class="btn">Cek Status Pengajuan</a>
            </div>
        </div>
        <div class="footer">
            Email ini dikirimkan secara otomatis oleh Sistem JEBOL. Mohon untuk tidak membalas email ini.
        </div>
    </div>
</body>
</html>

