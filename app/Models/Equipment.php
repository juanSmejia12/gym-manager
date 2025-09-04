<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipment';

    protected $casts = [
        'condition' => 'boolean',
        'quantity' => 'integer',
        'weight' => 'decimal:2',
    ];

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'weight',
        'condition',
        'type_id',
    ];

    function type()
    {
        return $this->belongsTo(Type::class);
    }

    public $timestamps = true;
}
