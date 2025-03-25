<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Estudiante; // Asegúrate de importarlo
use App\Models\Profesor;   // Asegúrate de importarlo

class Persona extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'password'];

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'persona_id', 'id');
    }

    public function profesor()
    {
        return $this->hasOne(Profesor::class, 'persona_id', 'id');
    }
}
