<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi; // Pastikan Model Aspirasi sudah ada
use Illuminate\Http\Request;
use App\Models\Siswa; // <--- Tambahkan ini!

class AspirasiController extends Controller
{
    public function index()
{
    // Mengambil data utama
    $total_aspirasi = Aspirasi::count();
    $total_siswa = Siswa::count(); // <--- Pastikan baris ini ada!
    $total_proses = Aspirasi::where('status', 'proses')->count();
    $total_selesai = Aspirasi::where('status', 'selesai')->count();
    
    // Mengambil data untuk tabel
    $aspirasi_terbaru = Aspirasi::with('siswa')->latest()->limit(5)->get();

    // Kirim SEMUA variabel ke view
    return view('dashboard', compact(
        'total_aspirasi', 
        'total_siswa', // <--- Jangan lupa masukkan ke compact
        'total_proses', 
        'total_selesai', 
        'aspirasi_terbaru'
    ));
}
}