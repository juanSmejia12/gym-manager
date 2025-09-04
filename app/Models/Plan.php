<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';

    protected $casts = [
        'price' => 'decimal:2',
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public $timestamps = true;
}
