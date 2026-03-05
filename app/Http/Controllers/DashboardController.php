<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Aspirasi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data dengan Eager Loading
        $aspirasi_terbaru = Aspirasi::with('siswa')->latest()->limit(10)->get();

        // 2. Hitung statistik
        $total_aspirasi   = Aspirasi::count();
        $total_siswa      = Siswa::count();
        $aspirasi_proses  = Aspirasi::where('status', 'proses')->count();
        $aspirasi_selesai = Aspirasi::where('status', 'selesai')->count(); // ✅ TAMBAHAN

        // 3. Kirim SEMUA variabel ke view
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
            'feedback'     => 'required|string|min:5',
            'status'       => 'required|in:proses,selesai', // ✅ lowercase sesuai DB
        ]);

        $aspirasi = Aspirasi::findOrFail($request->id_pelaporan);
        $aspirasi->update([
            'status'   => $request->status,
            'feedback' => $request->feedback,
        ]);

        return redirect()->back()->with('success', 'Respon berhasil dikirim ke aplikasi siswa!');
    }
}