<?php
// app/Models/Estudiante.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = ['persona_id', 'matricula'];

    // Relación con Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
