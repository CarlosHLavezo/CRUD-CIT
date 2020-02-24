@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                    <a type="button" href="{{ route('turma.listagem') }}" class="btn btn-primary btn-lg">Turmas</a>
                    <a type="button" href="{{ route('aluno.listagem') }}" class="btn btn-primary btn-lg">Alunos</a>
                </div>
            </div>
        </div>
        <div class="col-md-10" style="margin-top: 10px">
            <div class="card">
                <div class="card-header">Últimas Inscrições</div>

                <div class="card-body">
                    @if ($inscricoes->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Aluno</th>
                                    <th scope="col">Turma</th>
                                    <th scope="col">Data Inscrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscricoes as $inscricao)
                                    <tr>
                                        <td>{{ $inscricao->aluno_nome }}</td>
                                        <td>{{ $inscricao->turma_nome }}</td>
                                        <td>{{ $inscricao->data_inscricao }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info" role="alert">
                            Nenhum aluno encontrado.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
