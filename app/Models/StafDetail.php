<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StafDetail extends Model
{
    use HasFactory;

    protected
        $table = 'staf_details',
        $primaryKey = 'staf_id',
        $fillable = [
            'user_id',
            'nik_staf',
            'nama_staf',
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
