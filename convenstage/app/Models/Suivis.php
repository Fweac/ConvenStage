<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suivis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

    public function conventions()
    {
        return $this->hasMany(Convention::class);
    }

}
