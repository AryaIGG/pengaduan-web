<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    // Nama tabel sesuai di MariaDB
    protected $table = 'aspirasi';

    // Laravel mencari 'id', jadi kita arahkan ke 'id_pelaporan'
    protected $primaryKey = 'id_pelaporan';

    // Jika id_pelaporan bukan angka (misal UUID), set ini ke false
    public $incrementing = true;

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = ['nis', 'id_kategori', 'lokasi', 'ket', 'status'];

    public function siswa()
    {
        // Aspirasi ini dimiliki oleh satu Siswa berdasarkan kolom 'nis'
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}
