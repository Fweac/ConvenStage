<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convention extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordre',
        'suivis_id',
        'path',
    ];

    public function suivis()
    {
        return $this->belongsTo(Suivis::class);
    }
}
