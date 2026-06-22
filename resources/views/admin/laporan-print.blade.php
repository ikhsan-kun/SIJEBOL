<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>REKAPITULASI CAPAIAN IKD, KTP-EL, DAN KIA - {{ $bulan }}/{{ $tahun }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 9px; margin: 20px; color: #333; }
        .header { 
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
        }
        .header-logo {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }
        .header-text {
            text-align: center;
        }
        .header h2 { margin: 0; padding: 0; font-size: 13px; text-transform: uppercase; }
        .header p { margin: 5px 0; font-size: 10px; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 4px 2px; text-align: center; }
        th { background-color: #f2f2f2; font-weight: bold; text-transform: uppercase; font-size: 8px; }
        
        .text-left { text-align: left; padding-left: 5px; }
        .bg-blue { background-color: #e6f3ff; }
        .bg-indigo { background-color: #ebedff; }
        .bg-purple { background-color: #f6e6ff; }
        .bg-green { background-color: #e6ffec; }
        .font-bold { font-weight: bold; }
        
        .footer { margin-top: 30px; width: 100%; page-break-inside: avoid; }
        .footer table { border: none; }
        .footer td { border: none; text-align: center; width: 33%; font-size: 10px; }
        
        @media print {
            .no-print { display: none; }
            body { margin: 0; }
            @page { size: landscape; margin: 1cm; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body onload="window.print()">
    <div class="no-print" style="background: #ffeb3b; padding: 10px; margin-bottom: 20px; border: 1px solid #fbc02d; border-radius: 4px; font-weight: bold; font-size: 11px;">
        Halaman ini siap cetak (Landscape). Gunakan (Ctrl+P) untuk menyimpan sebagai PDF atau mencetak langsung.
        <a href="{{ route('admin.laporan') }}" style="float: right; text-decoration: none; color: #000;">&larr; Kembali</a>
    </div>

    <div class="header">
        <img src="{{ asset('images/logo-tegal.png') }}" class="header-logo" alt="Logo Tegal">
        <div class="header-text">
            <h2>REKAPITULASI CAPAIAN IKD, KTP-EL, DAN KIA</h2>
            <h2>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KOTA TEGAL</h2>
            <p>PERIODE: {{ strtoupper(\Carbon\Carbon::createFromFormat('m', $bulan)->translatedFormat('F')) }} {{ $tahun }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">KODE</th>
                <th rowspan="2" style="width: 150px;">WILAYAH</th>
                <th colspan="2" class="bg-blue">JUMLAH IKD</th>
                <th colspan="2" class="bg-indigo">JUMLAH KTP-EL</th>
                <th colspan="2" class="bg-purple">JUMLAH KIA</th>
            </tr>
            <tr>
                <th class="bg-blue">SUDAH</th>
                <th class="bg-blue">BELUM</th>
                <th class="bg-indigo">SUDAH</th>
                <th class="bg-indigo">BELUM</th>
                <th class="bg-purple">SUDAH</th>
                <th class="bg-purple">BELUM</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataLaporan as $item)
            @php
                $rowStyle = "";
                $textStyle = "text-left";
                if ($item['type'] == 'kota') {
                    $rowStyle = "background-color: #1d4ed8; color: white; font-weight: bold;";
                    $textStyle = "text-left font-bold color: white;";
                } elseif ($item['type'] == 'kecamatan') {
                    $rowStyle = "background-color: #dbeafe; font-weight: bold;";
                    $textStyle = "text-left font-bold;";
                }
            @endphp
            <tr style="{{ $rowStyle }}">
                <td>{{ $item['kode'] }}</td>
                <td class="{{ $textStyle }}" style="{{ $item['type'] == 'kelurahan' ? 'padding-left: 15px;' : '' }}">{{ $item['wilayah'] }}</td>
                <!-- IKD -->
                <td class="jbl-959">{{ number_format($item['ikd_sudah']) }}</td>
                <td>{{ number_format($item['ikd_belum']) }}</td>
                <!-- KTP -->
                <td class="jbl-959">{{ number_format($item['ktp_sudah']) }}</td>
                <td>{{ number_format($item['ktp_belum']) }}</td>
                <!-- KIA -->
                <td class="jbl-959">{{ number_format($item['kia_sudah']) }}</td>
                <td>{{ number_format($item['kia_belum']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <table>
            <tr>
                <td></td>
                <td></td>
                <td>
                    Tegal, {{ date('d') }} {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}<br>
                    <strong>KEPALA DINAS</strong><br><br><br><br><br>
                    <u>(...........................................)</u><br>
                    NIP. .....................................
                </td>
            </tr>
        </table>
    </div>
</body>
</html>

