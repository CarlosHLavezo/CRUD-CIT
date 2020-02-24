<?php
namespace App\Service;

use App\Turma;

class TurmaService {

    private $turma;

    public function __construct(Turma $turma)
    {
        $this->turma = $turma;
    }

    public function salvar($params)
    {
        if (!empty($params->get('id')) && is_numeric($params->get('id'))) {
            $this->turma = Turma::find($params->get('id'));
        }

        $this->turma->nome = $params->get('nome');

        $this->turma->save();
    }

}