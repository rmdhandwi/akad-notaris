<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotarisDetail extends Model
{
    use HasFactory;

    protected
        $table = 'notaris_details',
        $primaryKey = 'notaris_id',
        $fillable = [
            'user_id',
            'nik_notaris',
            'nama_notaris',
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
