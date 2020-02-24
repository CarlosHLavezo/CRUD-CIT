<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    Aluno,
    Turma
};
use Carbon\Carbon;

class AlunoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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

    public function atualizacao($id)
    {
        $aluno = Aluno::find($id);
        return view('aluno/atualizacao', ['aluno' => $aluno, 'turmas' => Turma::all()]);
    }

    public function salvar(Request $request)
    {
        if (!empty($request->input('id')) && is_numeric($request->input('id'))) {
            $aluno = Aluno::find($request->input('id'));
        } else {
            $aluno = new Aluno();
        }
        $aluno->nome = $request->input('nome');
        $aluno->sexo = $request->input('sexo');
        $data_nasc = Carbon::createFromFormat('d/m/Y', $request->input('data_nascimento'));
        $aluno->data_nascimento = $data_nasc->format('Y-m-d');
        $aluno->save();

        return redirect(route('aluno.listagem'));
    }

    public function excluir($id)
    {
        $aluno = Aluno::find($id);
        $aluno->delete();

        return redirect(route('aluno.listagem'));
    }
}
