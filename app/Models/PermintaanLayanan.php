<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanLayanan extends Model
{
    use HasFactory;

    protected
        $table = 'permintaan_layanan',
        $primaryKey = 'id_permintaan',
        $fillable = [
            'id_jenis',
            'id_pihak',
            'id_staf',
            'id_jadwal',
            'tgl_permintaan',
            'status',
        ];

    public function pihak()
    {
        return $this->belongsTo(DataPihak::class, 'id_pihak', 'id_pihak');
    }

    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class, 'id_jenis', 'id_jenis');
    }
}
