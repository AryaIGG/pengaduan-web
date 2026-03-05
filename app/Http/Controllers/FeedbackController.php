<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Aspirasi;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_pelaporan' => 'required',
            'feedback'     => 'required',
            'status'       => 'required'
        ]);

        // 1. Simpan ke tabel feedback
        Feedback::create([
            'id_pelaporan' => $request->id_pelaporan,
            'feedback'     => $request->feedback,
            'id_kategori'  => 1, // Sesuaikan dengan logika kategori kamu
        ]);

        // 2. Update status di tabel aspirasi
        Aspirasi::where('id_pelaporan', $request->id_pelaporan)
                ->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim!');
    }
}