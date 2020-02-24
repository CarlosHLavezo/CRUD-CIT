@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">Cadastro de Aluno(s)</div>

            <div class="card-body">
                <form action="{{ route('aluno.salvar') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="inpNomeAluno">Nome</label>
                        <input type="text" name="nome" class="form-control" id="inpNomeAluno" placeholder="Nome da Aluno">
                    </div>
                    <div class="form-group">
                        <label for="selectSexo">Sexo</label>
                        <select class="form-control" name="sexo" id="selectSexo">
                            <option value="">Selecione</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inpDataNasc">Data Nascimento</label>
                        <input type="text" name="data_nascimento" class="form-control" id="inpDataNasc" placeholder="Data de Nascimento">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection