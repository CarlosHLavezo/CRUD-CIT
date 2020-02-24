<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{

    protected $table = 'turma';

    public function inscricao()
    {
        return $this->hasMany(\App\Inscricao::class, 'id', 'turma_id');
    }

}
