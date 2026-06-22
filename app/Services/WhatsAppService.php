<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class WhatsAppService
{
    /**
     * Pengiriman Pesan WhatsApp via Fonnte API
     */
    public static function send($phone, $message)
    {
        try {
            $settings = DB::table('app_settings')->first();
            $notif = json_decode($settings->notification_settings ?? '{}');
            
            // Format nomor HP (Ganti 08 menjadi 628)
            $phone = preg_replace('/^0/', '62', $phone);
            
            if (isset($notif->wa_active) && $notif->wa_active && !empty($notif->fonnte_token)) {
                // Mode Live API (Fonnte)
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => $notif->fonnte_token
                ])->post('https://api.fonnte.com/send', [
                    'target' => $phone,
                    'message' => $message,
                    'delay' => '2', // Delay 2 seconds to avoid spam flag
                    'countryCode' => '62', // Optional
                ]);
                
                $responseData = $response->json();
                
                if ($response->successful() && isset($responseData['status']) && $responseData['status'] === true) {
                    Log::info("WhatsApp berhasil dikirim ke $phone via Fonnte.");
                    return true;
                } else {
                    Log::error("Fonnte API Error: " . $response->body());
                    return false;
                }
            } else {
                // Mode Log (Fallback jika Gateway tidak aktif atau API Key kosong)
                $logMessage = "
=========================================================
MENGIRIM WHATSAPP (LOG MODE - GATEWAY INACTIVE)
Tujuan : {$phone}
Pesan  : {$message}
Status : Sukses (Log Mode)
=========================================================";

                Log::info($logMessage);
                return true;
            }
        } catch (\Exception $e) {
            Log::error("WhatsAppService Exception: " . $e->getMessage());
            return false;
        }
    }
}
