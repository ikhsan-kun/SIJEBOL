<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LogSuccessfulLogin
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Login $event): void
    {
        // Only log login histories for Admin/Cabang users (App\Models\User)
        // Masyarakat doesn't have an 'id' column and would violate the foreign key constraint
        if ($event->user instanceof \App\Models\User) {
            DB::table('login_histories')->insert([
                'user_id' => $event->user->id,
                'ip_address' => $this->request->ip(),
                'user_agent' => $this->request->userAgent(),
                'login_at' => now(),
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
