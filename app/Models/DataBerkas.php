<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataBerkas extends Model
{
    use HasFactory;

    protected $table = 'data_berkas';
    protected $primaryKey = 'id_berkas';

    protected $fillable = [
        'id_jenis',
        'nama_berkas',
    ];

    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class, 'id_jenis', 'id_jenis');
    }
}
