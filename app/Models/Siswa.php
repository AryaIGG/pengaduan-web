<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    // 1. Beritahu Laravel nama tabel aslinya
    protected $table = 'siswa';

    // 2. Beritahu Laravel Primary Key-nya adalah 'nis' (bukan 'id')
    protected $primaryKey = 'nis';

    // 3. Matikan auto-increment jika NIS diisi manual
    public $incrementing = false;

    protected $fillable = ['nis', 'nama', 'kelas'];
    
    // Opsional: Jika tabel siswa tidak punya kolom created_at/updated_at
    // public $timestamps = false;
}