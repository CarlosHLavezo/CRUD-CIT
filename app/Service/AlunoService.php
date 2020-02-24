<?php
namespace App\Service;

use App\Aluno;
use Carbon\Carbon;

class AlunoService {

    private $aluno;

    public function __construct(Aluno $aluno)
    {
        $this->aluno = $aluno;
    }

    public function salvar($params)
    {
        if (!empty($params->get('id')) && is_numeric($params->get('id'))) {
            $this->aluno = Aluno::find($params->get('id'));
        }

        $this->aluno->nome = $params->get('nome');
        $this->aluno->sexo = $params->get('sexo');
        $data_nasc = Carbon::createFromFormat('d/m/Y', $params->get('data_nascimento'));
        $this->aluno->data_nascimento = $data_nasc->format('Y-m-d');

        $this->aluno->save();
    }

    public function consultarPeloID($id)
    {
        return Aluno::find($id);
    }

    public function consultartodos()
    {
        return Aluno::all();
    }

    public function excluir($id)
    {
        $aluno = Aluno::find($id);
        $aluno->delete();
    }

}