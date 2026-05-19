<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function download()
    {
        $filename = 'backup-matanu-' . date('Y-m-d-H-i-s') . '.sql';
        $path = storage_path('app/' . $filename);

        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $command = "mysqldump -h {$host} -u {$username} " .
            ($password ? "-p{$password} " : "") .
            "{$database} > {$path}";

        exec($command);

        return response()->download($path)->deleteFileAfterSend(true);
    }
}