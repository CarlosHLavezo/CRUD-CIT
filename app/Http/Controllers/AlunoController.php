<?php

namespace App\Http\Controllers;

use App\Http\Requests\{
    AlunoSalvarRequest,
    AlunoAtualizarRequest
};
use App\{
    Aluno,
    Turma
};

use App\Service\AlunoService;

class AlunoController extends Controller
{

    private $alunoService;

    public function __construct(AlunoService $alunoService)
    {
        $this->middleware('auth');

        $this->alunoService = $alunoService;
    }

    public function listagem()
    {
        $alunos = Aluno::all();

        return view('aluno/listagem', ['alunos' => $alunos]);
    }

    public function cadastro()
    {
        return view('aluno/cadastro', ['turmas' => Turma::all()]);
    }

    public function salvar(AlunoSalvarRequest $request)
    {
        $this->alunoService->salvar(collect($request->all()));

        return redirect(route('aluno.listagem'));
    }

    public function atualizacao($id)
    {
        $aluno = Aluno::find($id);
        return view('aluno/atualizacao', ['aluno' => $aluno, 'turmas' => Turma::all()]);
    }

    public function atualizar(AlunoAtualizarRequest $request)
    {
        $this->alunoService->salvar(collect($request->all()));

        return redirect(route('aluno.listagem'));
    }

    public function excluir($id)
    {
        $aluno = Aluno::find($id);
        $aluno->delete();

        return redirect(route('aluno.listagem'));
    }
}
