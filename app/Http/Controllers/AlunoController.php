<?php

namespace App\Http\Controllers;

use App\Http\Requests\{
    AlunoSalvarRequest,
    AlunoAtualizarRequest
};
use App\Service\{
    AlunoService,
    TurmaService
};

class AlunoController extends Controller
{

    private $alunoService;
    private $turmaService;

    public function __construct(AlunoService $alunoService, TurmaService $turmaService)
    {
        $this->middleware('auth');

        $this->alunoService = $alunoService;
        $this->turmaService = $turmaService;
    }

    public function listagem()
    {
        return view(
            'aluno/listagem',
            ['alunos' => $this->alunoService->consultartodos()]);
    }

    public function cadastro()
    {
        return view(
            'aluno/cadastro',
            ['turmas' => $this->turmaService->consultarTodas()]
        );
    }

    public function salvar(AlunoSalvarRequest $request)
    {
        $this->alunoService->salvar(collect($request->all()));

        return redirect(route('aluno.listagem'));
    }

    public function atualizacao($id)
    {
        return view(
            'aluno/atualizacao',
            [
                'aluno' => $this->alunoService->consultarPeloID($id),
                'turmas' => $this->turmaService->consultarTodas()
            ]
        );
    }

    public function atualizar(AlunoAtualizarRequest $request)
    {
        $this->alunoService->salvar(collect($request->all()));

        return redirect(route('aluno.listagem'));
    }

    public function excluir($id)
    {
        $this->alunoService->excluir($id);

        return redirect(route('aluno.listagem'));
    }
}
