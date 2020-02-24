<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{

    protected $table = 'inscricao';

    public function aluno()
    {
        return $this->belongsTo(\App\Aluno::class, 'id_aluno', 'id');
    }

    public function turma()
    {
        return $this->belongsTo(\App\Turma::class, 'id', 'id_turma');
    }

}
