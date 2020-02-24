<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\{
    Aluno,
    Turma,
    Inscricao
};
use App\Service\InscricaoService;

class InscricaoController extends Controller
{

    private $inscricaoService;

    public function __construct(InscricaoService $inscricaoService)
    {
        $this->middleware('auth');

        $this->inscricaoService = $inscricaoService;
    }

    public function inscreverPeloAluno(Request $request)
    {
        $params = collect($request->all());
        if (!$this->inscricaoService->inscricaoExiste($params)) {
            $this->inscricaoService->inscrever($params);
        }

        return redirect(route('inscricao.peloAluno', ['idAluno' => $request->input('aluno_id')]));
    }

    public function incricaoPeloAluno($idAluno)
    {
        $turmaSemInscricao = Turma::whereNotExists(function($query) use ($idAluno)
        {
            $query->select(DB::raw(1))
                  ->from('inscricao')
                  ->whereRaw('turma.id = inscricao.turma_id')
                  ->where('inscricao.aluno_id', $idAluno);
        })->get();

        $turmaComInscricao = Turma::whereExists(function($query) use ($idAluno)
        {
            $query->select(DB::raw(1))
                  ->from('inscricao')
                  ->whereRaw('turma.id = inscricao.turma_id')
                  ->where('inscricao.aluno_id', $idAluno);
        })->get();

        $aluno = Aluno::find($idAluno);

        return view(
            'inscricao/peloAluno', 
            [
                'aluno' => $aluno, 
                'turmaSemInscricao' => $turmaSemInscricao,
                'turmaComInscricao' => $turmaComInscricao
            ]
        );
    }

    public function removerPeloAluno($idAluno, $idTurma)
    {
        $inscricao = Inscricao::where('turma_id', $idTurma)
            ->where('aluno_id', $idAluno);
        $inscricao->delete();

        return redirect(route('inscricao.peloAluno', ['idAluno' => $idAluno]));
    }

    public function inscreverPelaTurma(Request $request)
    {
        $params = collect($request->all());
        if (!$this->inscricaoService->inscricaoExiste($params)) {
            $this->inscricaoService->inscrever($params);
        }

        return redirect(route('inscricao.pelaTurma', ['idTurma' => $request->input('turma_id')]));
    }

    public function incricaoPelaTurma($idTurma)
    {
        $alunoSemInscricao = Aluno::whereNotExists(function($query) use ($idTurma)
        {
            $query->select(DB::raw(1))
                  ->from('inscricao')
                  ->whereRaw('aluno.id = inscricao.aluno_id')
                  ->where('inscricao.turma_id', $idTurma);
        })->get();

        $alunoComInscricao = Aluno::whereExists(function($query) use ($idTurma)
        {
            $query->select(DB::raw(1))
                  ->from('inscricao')
                  ->whereRaw('aluno.id = inscricao.aluno_id')
                  ->where('inscricao.turma_id', $idTurma);
        })->get();

        $turma = Turma::find($idTurma);

        return view(
            'inscricao/pelaTurma', 
            [
                'turma' => $turma, 
                'alunoSemInscricao' => $alunoSemInscricao,
                'alunoComInscricao' => $alunoComInscricao
            ]
        );
    }

    public function removerPelaTurma($idTurma, $idAluno)
    {
        $inscricao = Inscricao::where('turma_id', $idTurma)
            ->where('aluno_id', $idAluno);
        $inscricao->delete();

        return redirect(route('inscricao.pelaTurma', ['idTurma' => $idTurma]));
    }

    public function listarInscricoes()
    {
        $inscricoes = Inscricao::select(
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

        return view('inscricao.lista', ['inscricoes' => $inscricoes]);
    }
}
