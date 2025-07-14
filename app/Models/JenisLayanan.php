<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisLayanan extends Model
{
    use HasFactory;

    protected $table = 'jenis_layanan';
    protected $primaryKey = 'id_jenis';
    public $timestamps = false;

    protected $fillable = [
        'id_kategori',
        'nama_jenis',
        'deskripsi_jenis',
    ];

    public function kategoriLayanan()
    {
        return $this->belongsTo(KategoriLayanan::class, 'id_kategori', 'id_kategori');
    }

    public function dataBerkas()
    {
        return $this->hasMany(DataBerkas::class, 'id_jenis', 'id_jenis');
    }
}
