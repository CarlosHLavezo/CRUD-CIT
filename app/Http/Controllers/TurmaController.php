<?php

namespace App\Http\Controllers;

use App\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listagem()
    {
        return view('turma/listagem', ['turmas' => Turma::all()]);
    }

    public function cadastro()
    {
        return view('turma/cadastro');
    }

    public function atualizacao($id)
    {
        $turma = Turma::find($id);
        return view('turma/atualizacao', ['turma' => $turma]);
    }

    public function salvar(Request $request)
    {
        $turma = !empty($request->input('id')) && is_numeric($request->input('id'))
            ? Turma::find($request->input('id'))
            : new Turma();

        $turma->nome = $request->input('nome');
        $turma->save();

        return redirect(route('turma.listagem'));
    }

    public function excluir($id)
    {
        $turma = Turma::find($id);
        $turma->delete();

        return redirect(route('turma.listagem'));
    }

}
