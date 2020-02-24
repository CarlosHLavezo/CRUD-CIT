@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-top: 10px">
            <div class="card">
                <div class="card-header">Listagem de Turma(s)</div>

                <div class="card-body">
                    @if ($turmas->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Qtd. Insc.</th>
                                    <th scope="col">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($turmas as $turma)
                                    <tr>
                                        <th scope="row">{{ $turma->id }}</th>
                                        <td>{{ $turma->nome }}</td>
                                        <td>{{ $turma->inscricao->count() }}</td>
                                        <td>
                                            <a type="button" href="{{ route('inscricao.pelaTurma', ['idTurma' => $turma->id]) }}" class="btn btn-secondary">Inscrever</a>
                                            <a type="button" href="{{ route('turma.atualizacao', ['id' => $turma->id]) }}" class="btn btn-primary">Editar</a>
                                            <a type="button" href="{{ route('turma.excluir', ['id' => $turma->id]) }}" class="btn btn-danger">Excluir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info" role="alert">
                            Nenhuma turma encontrada.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection