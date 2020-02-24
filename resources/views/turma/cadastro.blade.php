@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">Cadastro de Turma(s)</div>

            <div class="card-body">
                <form action="{{ route('turma.salvar') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="inpNomeTurma">Nome</label>
                        <input type="text" name="nome" class="form-control" id="inpNomeTurma" placeholder="Nome da Turma">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection