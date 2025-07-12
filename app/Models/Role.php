<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // define table primary key column
    protected $primaryKey = 'role_id';

    // define table fillable column
    protected $fillable = [
        'role_name',
    ];

    // define table relationship
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
