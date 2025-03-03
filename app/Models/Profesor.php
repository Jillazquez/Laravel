<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $fillable = ['nombre', 'email'];

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class);
    }
}
