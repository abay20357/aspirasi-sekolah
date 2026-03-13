<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = User::all();

echo "Total Users: " . $users->count() . "\n";

foreach ($users as $user) {
    echo "ID: " . $user->id . "\n";
    echo "Name: " . $user->name . "\n";
    echo "Username: " . $user->username . "\n";
    echo "Email: " . $user->email . "\n";
    echo "NIS: " . $user->nis . "\n";
    echo "Role: " . $user->role . "\n";
    echo "Password check 'password': " . (Hash::check('password', $user->password) ? 'MATCH' : 'NO MATCH') . "\n";
    echo "-------------------------\n";
}
