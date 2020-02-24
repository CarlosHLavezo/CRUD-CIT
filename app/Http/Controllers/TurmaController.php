<?php

namespace App\Http\Controllers;

use App\Service\{
    TurmaService,
    AlunoService
};
use App\Http\Requests\{
    TurmaSalvarRequest,
    TurmaAtualizarRequest
};

class TurmaController extends Controller
{

    private $turmaService;

    public function __construct(TurmaService $turmaService, AlunoService $alunoService)
    {
        $this->middleware('auth');

        $this->turmaService = $turmaService;
        $this->alunoService = $alunoService;
    }

    public function listagem()
    {
        return view(
            'turma/listagem',
            ['turmas' => $this->turmaService->consultarTodas()]
        );
    }

    public function cadastro()
    {
        return view('turma/cadastro');
    }

    public function salvar(TurmaSalvarRequest $request)
    {
        $this->turmaService->salvar(collect($request->all()));

        return redirect(route('turma.listagem'));
    }

    public function atualizacao($id)
    {
        return view(
            'turma/atualizacao',
            ['turma' => $this->turmaService->consultarPeloID($id)]
        );
    }

    public function atualizar(TurmaAtualizarRequest $request)
    {
        $this->turmaService->salvar(collect($request->all()));

        return redirect(route('turma.listagem'));
    }

    public function excluir($id)
    {
        $this->turmaService->excluir($id);

        return redirect(route('turma.listagem'));
    }

}
