<?php

$file = __DIR__ . '/routes/web.php';
$content = file_get_contents($file);

// Replace User usage in setup-admin
$content = str_replace(
    '\App\Models\User::where(\'email\', \'admin@jebol.com\')->delete();',
    '\App\Models\Admin::where(\'username\', \'admin@jebol.com\')->delete();',
    $content
);
$content = str_replace(
    '\App\Models\User::where(\'email\', \'cabang@jebol.com\')->delete();',
    '\App\Models\Admin::where(\'username\', \'cabang@jebol.com\')->delete();',
    $content
);
$content = preg_replace(
    "/\\\\App\\\\Models\\\\User::create\(\[\s*'name' => 'Admin Jebol',\s*'email' => 'admin@jebol\.com',\s*'password' => Hash::make\('admin123'\),\s*'role' => 'admin',[^\]]+\]\);/s",
    "\\App\\Models\\Admin::create([\n            'nama_admin' => 'Admin Jebol',\n            'username' => 'admin@jebol.com',\n            'password' => Hash::make('admin123'),\n            'role' => 'admin',\n        ]);",
    $content
);
$content = preg_replace(
    "/\\\\App\\\\Models\\\\User::create\(\[\s*'name' => 'Petugas Cabang Tegal Timur',\s*'email' => 'cabang@jebol\.com',\s*'password' => Hash::make\('cabang123'\),\s*'role' => 'petugas',[^\]]+\]\);/s",
    "\\App\\Models\\Admin::create([\n            'nama_admin' => 'Petugas Cabang Tegal Timur',\n            'username' => 'cabang@jebol.com',\n            'password' => Hash::make('cabang123'),\n            'role' => 'petugas',\n        ]);",
    $content
);

// Fix Admin Login
$content = str_replace(
    "\$user = User::where('email', \$credentials['email'])->first();\n\n    if (\$user && \$user->role === 'admin') {\n        if (Hash::check(\$credentials['password'], \$user->password)) {\n            Auth::login(\$user);",
    "\$user = \App\Models\Admin::where('username', \$credentials['email'])->first();\n\n    if (\$user && \$user->role === 'admin') {\n        if (Hash::check(\$credentials['password'], \$user->password)) {\n            Auth::guard('admin')->login(\$user);",
    $content
);

// Fix Cabang Login
$content = str_replace(
    "\$user = User::where('email', \$credentials['email'])->first();\n\n    if (\$user && \$user->role === 'petugas') {\n        if (Hash::check(\$credentials['password'], \$user->password)) {\n            Auth::login(\$user);",
    "\$user = \App\Models\Admin::where('username', \$credentials['email'])->first();\n\n    if (\$user && \$user->role === 'petugas') {\n        if (Hash::check(\$credentials['password'], \$user->password)) {\n            Auth::guard('admin')->login(\$user);",
    $content
);

// Fix Logout
$content = str_replace(
    "\$role = Auth::user() ? Auth::user()->role : 'user';\n    Auth::logout();",
    "if (Auth::guard('admin')->check()) {\n        \$role = Auth::guard('admin')->user()->role;\n        Auth::guard('admin')->logout();\n    } else {\n        \$role = 'user';\n        Auth::guard('masyarakat')->logout();\n    }",
    $content
);

// Fix User Register
$content = str_replace(
    "'nik' => 'required|unique:users',\n        'email' => 'required|email|unique:users',",
    "'nik' => 'required|unique:masyarakat,nik',\n        'email' => 'required|email|unique:masyarakat,email',",
    $content
);

$content = str_replace(
    "\$user = \App\Models\User::create([",
    "\$user = \App\Models\Masyarakat::create([",
    $content
);
$content = str_replace(
    "'name' => \$data['name'],",
    "'nama' => \$data['name'],",
    $content
);
$content = preg_replace(
    "/'role' => 'user',\s*/",
    "",
    $content
);
$content = preg_replace(
    "/'location_type' => \\\$data\['location_type'\],\s*/",
    "",
    $content
);
$content = preg_replace(
    "/'kecamatan' => \\\$kecamatan,\s*/",
    "",
    $content
);
$content = preg_replace(
    "/'desa' => \\\$request->desa,\s*/",
    "",
    $content
);
$content = preg_replace(
    "/'sekolah_level' => \\\$request->sekolah_level,\s*/",
    "",
    $content
);
$content = preg_replace(
    "/'sekolah_kecamatan' => \\\$request->sekolah_kecamatan,\s*/",
    "",
    $content
);
$content = preg_replace(
    "/'school' => \\\$request->school,\s*/",
    "",
    $content
);
$content = str_replace(
    "'phone' => \$data['phone'],",
    "'no_hp' => \$data['phone'],",
    $content
);

// Fix User Login
$content = str_replace(
    "if (Auth::attempt(['nik' => \$credentials['nik'], 'password' => \$credentials['password']])) {\n        \$user = Auth::user();\n        if (\$user->role === 'admin') return redirect()->route('admin.dashboard');\n        if (\$user->role === 'petugas') return redirect()->route('cabang.dashboard');",
    "if (Auth::guard('masyarakat')->attempt(['nik' => \$credentials['nik'], 'password' => \$credentials['password']])) {\n        \$user = Auth::guard('masyarakat')->user();",
    $content
);

file_put_contents($file, $content);
echo "Updated routes/web.php Auth sections.\n";
