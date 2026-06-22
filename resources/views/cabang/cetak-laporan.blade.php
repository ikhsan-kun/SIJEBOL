<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak Laporan - SI JEBOL</title>
    <style>
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            font-size: 14px; 
            color: #333333; 
            margin: 0; 
            padding: 30px; 
            line-height: 1.5;
        }
        .no-print {
            margin-bottom: 20px;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background-color: #f1f5f9;
            color: #334155;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            border: 1px solid #cbd5e1;
            transition: all 0.2s;
        }
        .btn-back:hover {
            background-color: #e2e8f0;
            color: #0f172a;
        }
        .header { 
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            border-bottom: 3px double #333333;
            padding-bottom: 20px;
        }
        .header-logo {
            width: 85px;
            height: auto;
            margin-right: 25px;
        }
        .header-text {
            text-align: center;
        }
        .header h1 { 
            font-size: 22px; 
            margin: 0; 
            text-transform: uppercase; 
            font-weight: 700;
            color: #0f172a;
        }
        .header p { 
            margin: 8px 0 0; 
            font-size: 15px; 
            color: #475569;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 30px; 
            font-size: 13px;
        }
        th, td { 
            border: 1px solid #cbd5e1; 
            padding: 10px 12px; 
            text-align: left; 
        }
        th { 
            background-color: #0f172a !important; 
            color: #ffffff !important; 
            text-align: center; 
            font-weight: bold; 
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
        }
        .text-center { 
            text-align: center; 
        }
        .text-right { 
            text-align: right; 
        }
        .font-bold { 
            font-weight: bold; 
        }
        .rekap-box { 
            margin-top: 30px; 
            padding: 20px; 
            background-color: #f8fafc; 
            border: 1px solid #e2e8f0; 
            border-radius: 8px;
            max-width: 350px;
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
        }
        .rekap-box h3 { 
            margin: 0 0 15px 0; 
            font-size: 16px; 
            color: #0f172a; 
            border-bottom: 2px solid #cbd5e1; 
            padding-bottom: 8px;
        }
        .rekap-box p { 
            margin: 8px 0; 
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }
        .rekap-box p strong {
            color: #0f172a;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body { padding: 0; }
            @page { margin: 1.5cm; }
            .rekap-box {
                background-color: #f8fafc !important;
                border: 1px solid #e2e8f0 !important;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print">
        <a href="{{ route('cabang.laporan', ['tab' => $tab, 'tahun' => $tahun, 'bulan' => $bulan]) }}" class="btn-back">
            &larr; Kembali ke Laporan
        </a>
    </div>

    <div class="header">
        <img src="{{ asset('images/logo-tegal.png') }}" class="header-logo" alt="Logo Tegal">
        <div class="header-text">
            <h1>LAPORAN PELAYANAN JEBOL PER SEKOLAH</h1>
            <p>Periode: {{ $bulan ? \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') : 'Januari - Desember' }} {{ $tahun }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th style="width: 100px;">NPSN</th>
                <th>Nama Sekolah</th>
                <th style="width: 70px;">Jenjang</th>
                <th>Wilayah</th>
                <th style="width: 100px; text-align: center;">Target Siswa</th>
                <th style="width: 100px; text-align: center;">Sudah Pelayanan</th>
                <th style="width: 100px; text-align: center;">Belum Pelayanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($school_stats as $stat)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center font-bold" style="font-family: monospace; font-size: 12px;">{{ $stat->npsn }}</td>
                    <td style="font-weight: bold; color: #0f172a;">{{ $stat->nama_sekolah }}</td>
                    <td class="text-center" style="text-transform: uppercase;">{{ $stat->tingkat }}</td>
                    <td>
                        {{ $stat->kecamatan }}
                        @if($stat->kelurahan && $stat->kelurahan !== '-')
                            <br><span style="font-size: 10px; color: #64748b; font-weight: bold; text-transform: uppercase;">{{ $stat->kelurahan }}</span>
                        @endif
                    </td>
                    <td class="text-center font-bold">{{ $stat->keseluruhan }}</td>
                    <td class="text-center font-bold" style="color: #16a34a;">{{ $stat->sudah }}</td>
                    <td class="text-center font-bold" style="color: #dc2626;">{{ $stat->belum }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="rekap-box">
        <h3>Rekapitulasi</h3>
        <p><span>Total Sekolah :</span> <strong>{{ $total_sekolah }}</strong></p>
        <p><span>Total KTP-el :</span> <strong>{{ $total_ktp }}</strong></p>
        <p><span>Total KIA :</span> <strong>{{ $total_kia }}</strong></p>
        <p><span>Total IKD :</span> <strong>{{ $total_ikd }}</strong></p>
        <p><span>Total Pelayanan :</span> <strong>{{ $total_pelayanan }}</strong></p>
    </div>

</body>
</html>
