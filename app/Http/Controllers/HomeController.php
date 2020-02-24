<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscricao;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $inscricoes = Inscricao::select(
                'turma.nome AS turma_nome',
                'aluno.nome AS aluno_nome',
                DB::raw('DATE_FORMAT(inscricao.created_at, \'%d/%m/%Y\') AS data_inscricao')
            )
            ->join('aluno', 'aluno.id', 'aluno_id')
            ->join('turma', 'turma.id', 'turma_id')
            ->limit(10)
            ->orderBy('inscricao.created_at')
            ->get();

        return view('home', ['inscricoes' => $inscricoes]);
    }
}
