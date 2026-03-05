<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Admin;

Route::get('/cek-koneksi', function () {
    try {
        $adminCount = Admin::count();
        return response()->json([
            'status' => 'Berhasil Konek!',
            'jumlah_admin' => $adminCount,
            'database' => config('database.connections.mariadb.database')
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'Gagal',
            'error' => $e->getMessage()
        ], 500);
    }
});