@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">Edição de Turma(s)</div>

            <div class="card-body">
                <form action="{{ route('turma.salvar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $turma->id }}">
                    <div class="form-group">
                        <label for="inpNomeTurma">Nome</label>
                        <input type="text" name="nome" class="form-control" id="inpNomeTurma" placeholder="Nome da Turma" value="{{ $turma->nome }}">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection