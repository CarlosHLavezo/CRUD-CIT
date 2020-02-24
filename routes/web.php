<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('aluno/')->group(function () {
    Route::get('listagem', 'AlunoController@listagem')->name('aluno.listagem');

    Route::get('cadastro', 'AlunoController@cadastro')->name('aluno.cadastro');
    Route::post('salvar', 'AlunoController@salvar')->name('aluno.salvar');

    Route::get('atualizacao/{id}', 'AlunoController@atualizacao')->name('aluno.atualizacao');
    Route::post('atualizar', 'AlunoController@atualizar')->name('aluno.atualizar');

    Route::get('excluir/{id}', 'AlunoController@excluir')->name('aluno.excluir');
});

Route::prefix('turma/')->group(function () {
    Route::get('listagem', 'TurmaController@listagem')->name('turma.listagem');
    
    Route::get('cadastro', 'TurmaController@cadastro')->name('turma.cadastro');
    Route::post('salvar', 'TurmaController@salvar')->name('turma.salvar');

    Route::get('atualizacao/{id}', 'TurmaController@atualizacao')->name('turma.atualizacao');
    Route::post('atualizar', 'TurmaController@atualizar')->name('turma.atualizar');

    Route::get('excluir/{id}', 'TurmaController@excluir')->name('turma.excluir');
});

Route::prefix('inscricao/')->group(function () {
    Route::get('aluno/{idAluno}', 'InscricaoController@incricaoPeloAluno')->name('inscricao.peloAluno');
    Route::get('turma/{idTurma}', 'InscricaoController@incricaoPelaTurma')->name('inscricao.pelaTurma');
    
    Route::post('inscrever/aluno', 'InscricaoController@inscreverPeloAluno')->name('inscricao.inscreverPeloAluno');
    Route::post('inscrever/turma', 'InscricaoController@inscreverPelaTurma')->name('inscricao.inscreverPelaTurma');

    Route::get('remover/aluno/{idAluno}/turma/{idTurma}', 'InscricaoController@removerPeloAluno')->name('inscricao.removerPeloAluno');
    Route::get('remover/turma/{idTurma}/aluno/{idAluno}', 'InscricaoController@removerPelaTurma')->name('inscricao.removerPelaTurma');

    Route::get('listagem', 'InscricaoController@listarInscricoes')->name('inscricao.listagem');
});