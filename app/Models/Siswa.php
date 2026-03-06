<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $primaryKey = 'nis';

    public $incrementing = false; // NIS bukan auto-increment

    protected $keyType = 'string';

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
    ];

    /**
     * Relasi ke Aspirasi
     */
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class, 'nis', 'nis');
    }
}
