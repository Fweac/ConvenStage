<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'date_fin',
        'etat',
        'ordre',
        'suivis_id',
        'user_id',
    ];

    public function suivis()
    {
        return $this->belongsTo(Suivis::class);
    }

}
