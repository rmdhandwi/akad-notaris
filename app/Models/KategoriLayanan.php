<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriLayanan extends Model
{
    use HasFactory;

    protected
        $table = 'kategori_layanan',
        $primaryKey = 'id_kategori',
        $fillable = [
            'nama_kategori',
            'deskripsi_kategori',
        ]
    ;

    public function jenisLayanan()
    {
        return $this->hasMany(JenisLayanan::class, 'id_kategori', 'id_kategori');
    }
}
