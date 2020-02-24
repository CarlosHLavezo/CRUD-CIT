@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2><strong>Nome:</strong> {{ $turma->nome }}</h2>
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
                    <form action="{{ route('inscricao.inscreverPelaTurma') }}" method="POST">
                        @csrf
                        <input type="hidden" name="turma_id" value="{{ $turma->id }}">
                        <div class="form-group">
                            <label for="selectTurma">Aluno</label>
                            <select class="form-control" name="aluno_id" id="selectTurma">
                                @if ($alunoSemInscricao->count() > 0)
                                    <option value="">Selecione</option>
                                    @foreach ($alunoSemInscricao as $aluno)
                                        <option value="{{ $aluno->id }}"> {{ $aluno->nome }}</option>
                                    @endforeach
                                @else
                                    <option value="">Nenhum aluno encontrado</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8" style="margin-top: 10px">
            <div class="card">
                <div class="card-header">Inscrições</div>

                <div class="card-body">
                    @if ($alunoComInscricao->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Sexo</th>
                                    <th scope="col">Data Nasc.</th>
                                    <th scope="col">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alunoComInscricao as $aluno)
                                    <tr>
                                        <th scope="row">{{ $aluno->id }}</th>
                                        <td>{{ $aluno->nome }}</td>
                                        <td>{{ $aluno->sexo == 'F' ? 'Feminino' : 'Masculino' }}</td>
                                        <td>{{ $aluno->data_nascimento }}</td>
                                        <td>
                                            <a type="button" href="{{ route('inscricao.removerPelaTurma', ['idTurma' => $turma->id, 'idAluno' => $aluno->id]) }}" class="btn btn-danger">Remover</a>
                                        </td>
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