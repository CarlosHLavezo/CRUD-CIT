<?php
namespace App\Service;

use App\Inscricao;

class InscricaoService {

    private $inscricao;

    public function __construct(Inscricao $inscricao)
    {
        $this->inscricao = $inscricao;
    }

    public function inscrever($params)
    {
        $this->inscricao->aluno_id = $params->get('aluno_id');
        $this->inscricao->turma_id = $params->get('turma_id');

        $this->inscricao->save();
    }

    public function inscricaoExiste($params)
    {
        $inscricao = Inscricao::where('turma_id', $params->get('turma_id'))
            ->where('aluno_id', $params->get('aluno_id'))
            ->get();

        return $inscricao->count() > 0;
    }

}