<?php

// app/Models/Profesor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $table = 'profesores';  // Especificamos el nombre correcto de la tabla

    protected $fillable = ['persona_id', 'departamento'];

    // Relación con Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
