@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10" style="margin-top: 10px">
            <div class="card">
                <div class="card-header">Aluno(s)</div>

                <div class="card-body">
                    @if ($alunos->count() > 0)
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
                                @foreach ($alunos as $aluno)
                                    <tr>
                                        <th scope="row">{{ $aluno->id }}</th>
                                        <td>{{ $aluno->nome }}</td>
                                        <td>{{ $aluno->sexo ==  'F' ? 'Feminino' : 'Masculino'}}</td>
                                        <td>{{ $aluno->data_nascimento }}</td>
                                        <td>
                                            <a type="button" href="{{ route('inscricao.peloAluno', ['idAluno' => $aluno->id]) }}" class="btn btn-secondary">Inscrição</a>
                                            <a type="button" href="{{ route('aluno.atualizacao', ['id' => $aluno->id]) }}" class="btn btn-primary">Editar</a>
                                            <a type="button" href="{{ route('aluno.excluir', ['id' => $aluno->id]) }}" class="btn btn-danger">Excluir</a>
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