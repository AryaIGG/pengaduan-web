<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Feedback;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Eager load siswa & kategori
        $aspirasi_terbaru = Aspirasi::with(['siswa', 'kategori'])->latest()->limit(10)->get();

        // Count — pakai whereRaw LOWER() agar case-insensitive (DB simpan "Proses"/"Menunggu"/"Selesai")
        $total_aspirasi = Aspirasi::count();
        $total_siswa = Siswa::count();
        $aspirasi_proses = Aspirasi::whereRaw('LOWER(status) = ?', ['proses'])->count();
        $aspirasi_selesai = Aspirasi::whereRaw('LOWER(status) = ?', ['selesai'])->count();

        return view('dashboard', compact(
            'total_aspirasi',
            'total_siswa',
            'aspirasi_proses',
            'aspirasi_selesai',
            'aspirasi_terbaru'
        ));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id_pelaporan' => 'required|exists:aspirasi,id_pelaporan',
            'feedback' => 'required|string|min:5',
            'status' => 'required|in:proses,selesai',
        ]);

        // 1. Update status di tabel aspirasi (simpan "Proses"/"Selesai" sesuai format DB)
        $aspirasi = Aspirasi::findOrFail($request->id_pelaporan);
        $aspirasi->update(['status' => ucfirst($request->status)]);

        // 2. Simpan feedback ke tabel feedback (sesuai struktur DB)
        Feedback::updateOrCreate(
            ['id_pelaporan' => $request->id_pelaporan],
            [
                'feedback' => $request->feedback,
                'status' => ucfirst($request->status),
                'id_kategori' => $aspirasi->id_kategori,
            ]
        );

        return redirect()->back()->with('success', 'Respon berhasil dikirim!');
    }
}
