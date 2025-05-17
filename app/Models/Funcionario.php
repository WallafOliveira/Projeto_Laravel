<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';
    protected $fillable = ['name', 'cpf', 'funcao', 'departamento_id'];

    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'departamento_id', 'id');
    }
}
