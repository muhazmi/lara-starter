<?php

namespace App\Http\Controllers\Admin\Other;

use App\Models\Backup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;

class BackupController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = __('Backup Database');
    }

    // Menampilkan halaman backup
    public function index()
    {
        // Ambil daftar backup dari database
        $backups = Backup::all();
        $page_title = $this->module; // Atur page_title sesuai kebutuhan

        return view('backend.other.backup.index', compact('backups', 'page_title'));
    }

    public function runBackup()
    {
        try {
            // Nama file backup dengan timestamp
            $timestamp = date('Ymd_His');
            $filename = 'backup_' . $timestamp . '.sql';
            $zipFilename = 'backup_' . $timestamp . '.zip';

            // Path penyimpanan file backup
            $storageDisk = Storage::disk('backup_db');

            // Pastikan direktori backup ada
            if (!$storageDisk->exists('/')) {
                $storageDisk->makeDirectory('/');
            }

            $sqlPath = storage_path('app/backup_db/' . $filename);
            $zipPath = storage_path('app/backup_db/' . $zipFilename);

            // Detail koneksi database
            $db = config('database.connections.' . config('database.default'));

            // Perintah mysqldump dengan pengalihan stderr ke /dev/null
            $command = sprintf(
                'mysqldump --user=%s --password=%s --host=%s %s > %s 2>/dev/null',
                escapeshellarg($db['username']),
                escapeshellarg($db['password']),
                escapeshellarg($db['host']),
                escapeshellarg($db['database']),
                escapeshellarg($sqlPath)
            );

            // Eksekusi perintah
            exec($command, $output, $returnVar);

            if ($returnVar !== 0) {
                throw new \Exception('Error creating backup.');
            }

            // Kompres file SQL menjadi zip
            $zip = new \ZipArchive();
            if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                $zip->addFile($sqlPath, $filename);
                $zip->close();
            } else {
                throw new \Exception('Could not create zip file.');
            }

            // Hapus file SQL setelah dikompres
            unlink($sqlPath);

            // Ukuran file backup zip
            $size = filesize($zipPath);

            // Simpan informasi backup ke database
            Backup::create([
                'filename' => $zipFilename,
                'size' => $size,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Hapus file jika terjadi error
            if (isset($sqlPath) && file_exists($sqlPath)) {
                unlink($sqlPath);
            }
            if (isset($zipPath) && file_exists($zipPath)) {
                unlink($zipPath);
            }

            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function deleteBackup($filename)
    {
        try {
            // Hapus file dari storage
            if (Storage::disk('backup_db')->exists($filename)) {
                Storage::disk('backup_db')->delete($filename);
            }

            // Hapus dari database
            Backup::where('filename', $filename)->delete();

            return redirect()->back()->with('success', 'Backup berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus backup.');
        }
    }

    public function deleteAllBackups()
    {
        try {
            // Hapus semua file backup dari storage
            $files = Storage::disk('backup_db')->files();
            Storage::disk('backup_db')->delete($files);

            // Hapus semua record dari database
            Backup::truncate();

            return redirect()->back()->with('success', 'Semua backup berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus semua backup.');
        }
    }

    public function download($filename)
    {
        $path = storage_path('app/backup_db/' . $filename);

        if (file_exists($path)) {
            return response()->download($path, $filename);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }
}
