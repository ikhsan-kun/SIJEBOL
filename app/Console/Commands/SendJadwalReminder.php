<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JadwalJebol;
use App\Models\User;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendJadwalReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jebol:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim notifikasi WA ke masyarakat tentang jadwal layanan jemput bola besok';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $besok = Carbon::tomorrow()->toDateString();
        $this->info("Mengecek jadwal layanan Jemput Bola untuk tanggal: $besok");

        $jadwalBesok = JadwalJebol::where('tanggal', $besok)->get();

        if ($jadwalBesok->isEmpty()) {
            $this->info("Tidak ada jadwal untuk besok.");
            return 0;
        }

        $notifTerkirim = 0;

        foreach ($jadwalBesok as $jadwal) {
            // Kita extract kecamatan dari lokasi atau field kecamatan jika ada
            // Berhubung database mungkin menyimpan "Kecamatan Tegal Timur" atau "Tegal Timur"
            $kecamatanKeyword = null;
            
            // Asumsi jadwal memiliki field kecamatan, jika tidak ada fallback ke regex lokasi
            if (!empty($jadwal->kecamatan)) {
                $kecamatanKeyword = $jadwal->kecamatan;
            } else {
                // Parsing lokasi sederhana
                if (stripos($jadwal->lokasi, 'Tegal Timur') !== false) $kecamatanKeyword = 'Tegal Timur';
                elseif (stripos($jadwal->lokasi, 'Tegal Barat') !== false) $kecamatanKeyword = 'Tegal Barat';
                elseif (stripos($jadwal->lokasi, 'Tegal Selatan') !== false) $kecamatanKeyword = 'Tegal Selatan';
                elseif (stripos($jadwal->lokasi, 'Margadana') !== false) $kecamatanKeyword = 'Margadana';
            }

            if ($kecamatanKeyword) {
                // Ambil masyarakat yang tinggal di kecamatan tersebut
                $warga = \App\Models\Masyarakat::where('role', 'user')
                             ->where('kecamatan', 'LIKE', '%' . $kecamatanKeyword . '%')
                             ->get();
                
                foreach ($warga as $user) {
                    if (!empty($user->phone)) {
                        $pesanWa = "Halo Bapak/Ibu " . $user->name . ",\n\nSekadar mengingatkan bahwa besok tanggal *" . Carbon::parse($jadwal->tanggal)->format('d-m-Y') . "* akan ada mobil layanan *Jemput Bola (SI JEBOL)* di wilayah:\n\n📍 *" . $jadwal->lokasi . "*\n⏰ " . $jadwal->jam_mulai . " - " . $jadwal->jam_selesai . "\n\nSilakan manfaatkan layanan ini untuk kemudahan administrasi kependudukan Anda.\n\n_Pesan ini dikirim otomatis oleh Sistem Disdukcapil._";
                        
                        WhatsAppService::send($user->phone, $pesanWa);
                        $notifTerkirim++;
                    }
                }
            }
        }

        $this->info("Berhasil mengirim $notifTerkirim pengingat WhatsApp.");
        Log::info("CronJob SendJadwalReminder dijalankan. Terkirim: $notifTerkirim notifikasi.");

        return 0;
    }
}
