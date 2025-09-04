<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'document',
        'email',
        'role_id',
    ];

    function role()
    {
        return $this->belongsTo(Rol::class);
    }

    public $timestamps = true;
}
