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
            'id_jenis',
            'nama_kategori_pihak',
        ];

    public function jenisLayanan()
    {
        return $this->BelongsTo(JenisLayanan::class, 'id_jenis' ,'id_jenis');
    }

    public function dataBerkas()
    {
        return $this->hasMany(DataBerkas::class, 'id_kategori_pihak', 'id_kategori_pihak');
    }
}
