<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJadwal extends Model
{
    use HasFactory;

    protected
        $table = 'data_jadwal',
        $primaryKey = 'id_jadwal',
        $fillable = [
            'notaris_id',
            'tanggal',
            'waktu_mulai',
            'waktu_selesai',
            'alasan',
        ],
        $casts = [
            'tanggal' => 'string',
            'waktu_mulai' => 'string',
            'waktu_selesai' => 'string',
        ];

    public function notaris()
    {
        return $this->belongsTo(NotarisDetail::class, 'notaris_id', 'notaris_id');
    }

    public function permintaan()
    {
        return $this->hasOne(PermintaanLayanan::class, 'id_jadwal','id_jadwal');
    }
}
