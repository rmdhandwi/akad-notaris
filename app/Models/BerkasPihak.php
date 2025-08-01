<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPihak extends Model
{
    use HasFactory;

    protected $table = 'berkas_pihak';
    protected $primaryKey = 'id_berkas_pihak';

    protected $fillable = [
        'id_permintaan',
        'id_berkas',
        'id_pihak',
        'berkas_path',
        'status'
    ];
}
