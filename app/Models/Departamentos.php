<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table = 'departamentos';
    protected $fillable = ['name', 'description', 'departamento_id'];

    public function funcionario(){
        return $this->hasMany(
            Funcionario::class,
            'departamento_id',
            'id'
        );
    }
}
