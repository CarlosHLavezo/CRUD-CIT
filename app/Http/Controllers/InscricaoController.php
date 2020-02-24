<?php

namespace App\Http\Controllers;

use App\Service\{
    AlunoService,
    InscricaoService,
    TurmaService
};
use App\Http\Requests\InscreverRequest;

class InscricaoController extends Controller
{

    private $inscricaoService;
    private $alunoService;
    private $turmaService;

    public function __construct(
        InscricaoService $inscricaoService, 
        AlunoService $alunoService,
        TurmaService $turmaService
    ) {
        $this->middleware('auth');

        $this->inscricaoService = $inscricaoService;
        $this->alunoService = $alunoService;;
        $this->turmaService = $turmaService;;
    }

    public function inscreverPeloAluno(InscreverRequest $request)
    {
        $params = collect($request->all());
        if (!$this->inscricaoService->inscricaoExiste($params)) {
            $this->inscricaoService->inscrever($params);
        }

        return redirect(route('inscricao.peloAluno', ['idAluno' => $request->input('aluno_id')]));
    }

    public function incricaoPeloAluno($idAluno)
    {
        return view(
            'inscricao/peloAluno', 
            [
                'aluno' => $this->alunoService->consultarPeloID($idAluno), 
                'turmaSemInscricao' => $this->inscricaoService->turmasSemInscricaoDoAluno($idAluno),
                'turmaComInscricao' => $this->inscricaoService->turmasComInscricaoDoAluno($idAluno)
            ]
        );
    }

    public function removerPeloAluno($idAluno, $idTurma)
    {
        $this->inscricaoService->removerInscricao(collect([
            'idTurma' => $idTurma,
            'idAluno' => $idAluno
        ]));

        return redirect(route('inscricao.peloAluno', ['idAluno' => $idAluno]));
    }

    public function inscreverPelaTurma(InscreverRequest $request)
    {
        $params = collect($request->all());
        if (!$this->inscricaoService->inscricaoExiste($params)) {
            $this->inscricaoService->inscrever($params);
        }

        return redirect(route('inscricao.pelaTurma', ['idTurma' => $request->input('turma_id')]));
    }

    public function incricaoPelaTurma($idTurma)
    {
        return view(
            'inscricao/pelaTurma', 
            [
                'turma' => $this->turmaService->consultarPeloID($idTurma), 
                'alunoSemInscricao' => $this->inscricaoService->alunosSemInscricaoNaTurma($idTurma),
                'alunoComInscricao' => $this->inscricaoService->alunosComInscricaoNaTurma($idTurma)
            ]
        );
    }

    public function removerPelaTurma($idTurma, $idAluno)
    {
        $this->inscricaoService->removerInscricao(collect([
            'idTurma' => $idTurma,
            'idAluno' => $idAluno
        ]));

        return redirect(route('inscricao.pelaTurma', ['idTurma' => $idTurma]));
    }

    public function listarInscricoes()
    {
        return view(
            'inscricao.lista',
            [
                'inscricoes' => $this->inscricaoService->consultarTodas()
            ]
        );
    }
}
