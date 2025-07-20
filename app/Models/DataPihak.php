<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPihak extends Model
{
    use HasFactory;

    protected
        $table = 'data_pihak',
        $primaryKey = 'id_pihak',
        $fillable = [
            'user_id',
            'id_pihak_terkait',
            'id_kategori_pihak',
            'nama_pihak',
            'nik_pihak',
            'no_hp_pihak',
            'alamat_pihak',
            'tipe_pihak',
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function kategoriPihak()
    {
        return $this->belongsTo(KategoriPihak::class, 'id_kategori_pihak', 'id_kategori_pihak');
    }

    public function permintaan()
    {
        return $this->hasOne(PermintaanLayanan::class, 'id_pihak','id_pihak');
    }

    public function pihakTerkait()
    {
        return $this->belongsTo(DataPihak::class, 'id_pihak_terkait', 'id_pihak_terkait');
    }
}
