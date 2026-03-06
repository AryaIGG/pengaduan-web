<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Tambahkan import model-model yang direlasikan di bawah ini:

class Aspirasi extends Model
{
    protected $table = 'aspirasi';

    protected $primaryKey = 'id_pelaporan';

    protected $fillable = [
        'nis',
        'id_kategori',
        'lokasi',
        'ket',
        'status',
    ];

    /**
     * Relasi ke Siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    /**
     * Relasi ke Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Relasi ke Feedback
     */
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'id_pelaporan', 'id_pelaporan');
    }
}
