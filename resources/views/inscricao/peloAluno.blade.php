@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2><strong>Nome:</strong> {{ $aluno->nome }}</h2>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('inscricao.inscreverPeloAluno') }}" method="POST">
                        @csrf
                        <input type="hidden" name="aluno_id" value="{{ $aluno->id }}">
                        <div class="form-group">
                            <label for="selectTurma">Turma</label>
                            <select class="form-control" name="turma_id" id="selectTurma">
                                @if ($turmaSemInscricao->count() > 0)
                                    <option value="">Selecione</option>
                                    @foreach ($turmaSemInscricao as $turma)
                                        <option value="{{ $turma->id }}"> {{ $turma->nome }}</option>
                                    @endforeach
                                @else
                                    <option value="">Nenhuma turma encontrada</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Inscrever</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8" style="margin-top: 10px">
            <div class="card">
                <div class="card-header">Inscrições</div>

                <div class="card-body">
                    @if ($turmaComInscricao->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($turmaComInscricao as $turma)
                                    <tr>
                                        <th scope="row">{{ $turma->id }}</th>
                                        <td>{{ $turma->nome }}</td>
                                        <td>
                                            <a type="button" href="{{ route('inscricao.removerPeloAluno', ['idTurma' => $turma->id, 'idAluno' => $aluno->id]) }}" class="btn btn-danger">Remover</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info" role="alert">
                            Nenhuma inscrição realizada.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection