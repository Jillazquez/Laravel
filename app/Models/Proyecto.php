<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;
    
    protected $table = 'proyectos';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    
    protected $fillable = ["titulo","horas_previstas","fecha_comienzo"];

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class);
    }
}
