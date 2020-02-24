<?php
namespace App\Service;

use Illuminate\Support\Facades\DB;
use App\{
    Aluno,
    Inscricao,
    Turma
};

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

    public function turmasComInscricaoDoAluno($idAluno)
    {
        return Turma::whereExists(function($query) use ($idAluno)
            {
                $query->select(DB::raw(1))
                    ->from('inscricao')
                    ->whereRaw('turma.id = inscricao.turma_id')
                    ->where('inscricao.aluno_id', $idAluno);
            })->get();
    }

    public function turmasSemInscricaoDoAluno($idAluno)
    {
        return Turma::whereNotExists(function($query) use ($idAluno)
            {
                $query->select(DB::raw(1))
                    ->from('inscricao')
                    ->whereRaw('turma.id = inscricao.turma_id')
                    ->where('inscricao.aluno_id', $idAluno);
            })->get();
    }

    public function alunosComInscricaoNaTurma($idTurma)
    {
        return Aluno::whereExists(function($query) use ($idTurma)
            {
                $query->select(DB::raw(1))
                    ->from('inscricao')
                    ->whereRaw('aluno.id = inscricao.aluno_id')
                    ->where('inscricao.turma_id', $idTurma);
            })->get();
    }

    public function alunosSemInscricaoNaTurma($idTurma)
    {
        return Aluno::whereNotExists(function($query) use ($idTurma)
            {
                $query->select(DB::raw(1))
                    ->from('inscricao')
                    ->whereRaw('aluno.id = inscricao.aluno_id')
                    ->where('inscricao.turma_id', $idTurma);
            })->get();
    }

    public function removerInscricao($params)
    {
        return Inscricao::where('turma_id', $params->get('idTurma'))
            ->where('aluno_id', $params->get('idAluno'))
            ->delete();
    }

    public function consultarTodas()
    {
        return Inscricao::select(
                'turma.nome AS turma_nome',
                'aluno.nome AS aluno_nome',
                'aluno.sexo AS aluno_sexo',
                DB::raw('DATE_FORMAT(aluno.data_nascimento, \'%d/%m/%Y\') AS data_nascimento'),
                DB::raw('DATE_FORMAT(inscricao.created_at, \'%d/%m/%Y\') AS data_inscricao')
            )
            ->join('aluno', 'aluno.id', 'aluno_id')
            ->join('turma', 'turma.id', 'turma_id')
            ->orderBy('inscricao.created_at')
            ->get();
    }

    public function consultarUltimasDez()
    {
        return Inscricao::select(
                'turma.nome AS turma_nome',
                'aluno.nome AS aluno_nome',
                DB::raw('DATE_FORMAT(inscricao.created_at, \'%d/%m/%Y\') AS data_inscricao')
            )
            ->join('aluno', 'aluno.id', 'aluno_id')
            ->join('turma', 'turma.id', 'turma_id')
            ->limit(10)
            ->orderBy('inscricao.created_at')
            ->get();
    }
}