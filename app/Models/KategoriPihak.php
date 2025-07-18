<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPihak extends Model
{
    use HasFactory;

    protected
        $table = 'kategori_pihak',
        $primaryKey = 'id_kategori_pihak',
        $fillable = [
            'nama_kategori_pihak',
        ];

    public function dataBerkas()
    {
        return $this->belongsTo(DataBerkas::class, 'id_kategori_pihak', 'id_kategori_pihak');
    }
}
