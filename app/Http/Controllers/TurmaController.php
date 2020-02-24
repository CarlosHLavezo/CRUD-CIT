<?php

namespace App\Http\Controllers;

use App\Turma;
use App\Service\TurmaService;
use App\Http\Requests\TurmaSalvarRequest;
use App\Http\Requests\TurmaAtualizarRequest;

class TurmaController extends Controller
{

    private $turmaService;

    public function __construct(TurmaService $turmaService)
    {
        $this->middleware('auth');

        $this->turmaService = $turmaService;
    }

    public function listagem()
    {
        return view('turma/listagem', ['turmas' => Turma::all()]);
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
        $turma = Turma::find($id);
        return view('turma/atualizacao', ['turma' => $turma]);
    }

    public function atualizar(TurmaAtualizarRequest $request)
    {
        $this->turmaService->salvar(collect($request->all()));

        return redirect(route('turma.listagem'));
    }

    public function excluir($id)
    {
        $turma = Turma::find($id);
        $turma->delete();

        return redirect(route('turma.listagem'));
    }

}
