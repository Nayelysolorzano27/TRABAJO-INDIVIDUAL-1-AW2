<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Paralelo extends Model
{
    //habilitar el guardado
    //enseñarle o mostrarle como esta estructurada las tablas 
    use HasFactory;
    protected $fillable =['nombre'];
    public function estudiantes(){
        return $this->hasMany (Estudiante::class);
    }
}
