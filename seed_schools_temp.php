<?php

$schoolData = [
    'tk' => [
        'Margadana' => ['TK NEGERI PEMBINA KECAMATAN MARGADANA', 'TK AISYIYAH BUSTANUL ATHFAL X', 'TK MASYITHOH VII', 'TK PERTIWI 25.12 KALINYAMAT KULON', 'TK TARBIYATUL ISLAMIYAH', 'TK PERTIWI KRANDON', 'TK PERTIWI CABAWAN', 'TK ABA SUMURPANGGANG'],
        'Tegal Barat' => ['TK AISYIYAH BUSTANUL ATHFAL VIII', 'TK AL KHAIRIYYAH', 'TK AL-IRSYAD AL-ISLAMIYAH', 'TK ASSYIFA', 'TK BAGYA WACANA', 'TK ELKANA', 'TK GLOBAL INBYRA SCHOOL', 'TK HANG TUAH 16', 'TK LITTLE STAR', 'TK PERTIWI 25.5 KRATON', 'TK PIUS'],
        'Tegal Selatan' => ['TK AISYIYAH BUSTANUL ATHFAL II', 'TK AISYIYAH BUSTANUL ATHFAL XIII', 'TK MASYITHOH I', 'TK MASYITHOH V', 'TK PERTIWI 25.1 RANDUGUNTING', 'TK PERTIWI 25.9 BANDUNG', 'TK BIAS ASSALAM', 'TK BAITUSH SHOBIRIN'],
        'Tegal Timur' => ['TK AISYIYAH I', 'TK AISYIYAH III', 'TK AISYIYAH VII', 'TK AISYIYAH IX', 'TK MASYITHOH II', 'TK MASYITHOH III', 'TK PERTIWI 25.13 KEJAMBON', 'TK PERTIWI 25.3 SLEROK', 'TK NEGERI PEMBINA KOTA TEGAL']
    ],
    'sd' => [
        'Margadana' => ['SD NEGERI MARGADANA 1', 'SD NEGERI KALINYAMAT KULON 1', 'SD NEGERI SUMURPANGGANG 1'],
        'Tegal Barat' => ['SD NEGERI KRATON 1', 'SD NEGERI PEKAUMAN 1', 'SD PIUS TEGAL'],
        'Tegal Selatan' => ['SD NEGERI RANDUGUNTING 1', 'SD NEGERI TUNON 1', 'SD MUHAMMADIYAH TEGAL'],
        'Tegal Timur' => ['SD NEGERI KEJAMBON 1', 'SD NEGERI SLEROK 1', 'SD AL IRSYAD TEGAL']
    ],
    'smp' => [
        'Kota Tegal' => ['SMP NEGERI 1 TEGAL', 'SMP NEGERI 2 TEGAL', 'SMP NEGERI 3 TEGAL', 'SMP NEGERI 4 TEGAL', 'SMP ISLAM AL IRSYAD TEGAL', 'SMP PIUS TEGAL']
    ],
    'slta' => [
        'Kota Tegal' => ['SMAN 1 TEGAL', 'SMAN 2 TEGAL', 'SMAN 3 TEGAL', 'SMKN 1 TEGAL', 'SMKN 2 TEGAL', 'SMK HARAPAN BERSAMA TEGAL', 'SMA AL IRSYAD TEGAL']
    ]
];

foreach ($schoolData as $tingkat => $kecamatanGroups) {
    foreach ($kecamatanGroups as $kecamatan => $schools) {
        foreach ($schools as $schoolName) {
            // Determine Cabang ID based on Kecamatan, or default to Tegal Timur if 'Kota Tegal'
            $cabangKecamatan = $kecamatan === 'Kota Tegal' ? 'Tegal Timur' : $kecamatan;
            $cabang = \App\Models\User::where('role', 'petugas')->where('kecamatan', $cabangKecamatan)->first();
            $cabangId = $cabang ? $cabang->id : 1;
            
            \App\Models\School::firstOrCreate(
                ['nama_sekolah' => $schoolName],
                [
                    'tingkat' => strtoupper($tingkat),
                    'kecamatan' => $kecamatan === 'Kota Tegal' ? 'Tegal Timur' : $kecamatan,
                    'status' => 'Swasta',
                    'jumlah_siswa' => rand(50, 200),
                    'cabang_id' => $cabangId,
                    'status_jempol' => 'Belum'
                ]
            );
        }
    }
}
echo "All schools seeded successfully!\n";
