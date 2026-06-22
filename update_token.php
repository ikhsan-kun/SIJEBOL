<?php
require __DIR__.'/vendor/autoload.php';
 = require_once __DIR__.'/bootstrap/app.php';
 = ->make(Illuminate\Contracts\Console\Kernel::class);
->bootstrap();
 = Illuminate\Support\Facades\DB::table('app_settings')->first();
 = json_decode(->notification_settings ?? '{{}}', true);
['fonnte_token'] = 'oLrKUMwNczGpmJwWpZzB';
Illuminate\Support\Facades\DB::table('app_settings')->where('id', 1)->update(['notification_settings' => json_encode()]);
echo " Token updated!\;
