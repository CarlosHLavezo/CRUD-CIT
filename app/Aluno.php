<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Aluno extends Model
{

    protected $table = 'aluno';

    public function inscricao()
    {
        return $this->hasMany(\App\Inscricao::class, 'id', 'aluno_id');
    }

    public function getDataNascimentoAttribute($value)
    {
        $dataNasc = Carbon::create($value);
        return $dataNasc->format('d/m/Y');
    }
}
