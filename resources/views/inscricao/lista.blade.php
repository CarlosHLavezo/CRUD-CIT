@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-top: 10px">
            <div class="card">
                <div class="card-body">
                    @if ($inscricoes->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Turma</th>
                                    <th scope="col">Aluno</th>
                                    <th scope="col">Sexo</th>
                                    <th scope="col">Data Nasc.</th>
                                    <th scope="col">Data Inscrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscricoes as $inscricao)
                                    <tr>
                                        <td>{{ $inscricao->turma_nome }}</td>
                                        <td>{{ $inscricao->aluno_nome }}</td>
                                        <td>{{ $inscricao->aluno_sexo == 'F' ? 'Feminino' : 'Masculino' }}</td>
                                        <td>{{ $inscricao->data_nascimento }}</td>
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