<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\funcionario;
use App\Models\Departamentos;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* --------------------Funcionarios----------------- */

Route::post('/criar_funcionarios', function (Request $request){
    $funcionario = new Funcionario();
    $funcionario->name = $request->input('name');
    $funcionario->cpf = $request->input('cpf');
    $funcionario->funcao = $request->input('funcao');
    $funcionario->departamento_id = $request->input('departamento_id'); 
    $funcionario->save();

    return response()->json($funcionario);
});


//exbir lista de funcionarios
Route::get('/exibir_funcionarios', function( ){
    $funcionario = Funcionario::all();
    return response()->json($funcionario);
});

Route::get('/busca_por_id/{id}',function($id){
    $funcionario = Funcionario::find($id);
    return response()->json($funcionario);
});

Route::patch('/atualizar_funcionarios/{id}', function(Request $request, $id){
    $funcionario = Funcionario::find($id);

    if ($request->input('name')!== null){
        $funcionario->name = $request->input('name');
    }

    if ($request->input('cpf')!== null){
        $funcionario->cpf = $request->input('cpf');
    }

    if ($request->input('funcao')!== null){
        $funcionario->funcao = $request->input('funcao');
    }

    if ($request->input('departamento_id') !== null){
        $funcionario->departamento_id = $request->input('departamento_id');
    }

    $funcionario->save();
    return response()->json($funcionario);
});

Route::delete('/deletar_funcionario/{id}', function($id){
    $funcionario = Funcionario::find($id);
    $funcionario->delete();
    return response()->json($funcionario);
});

/* -----------------Departamento------------------- */
    
Route::post('/criar_departamento', function (Request $request){
    $departamento = new Departamentos();
    $departamento->name = $request->input('name');
    $departamento->description = $request->input('description');
    $departamento->save();

    return response()->json($departamento);
});


Route::get('/exibir_departamentos', function( ){
    $departamento = Departamentos::all();
    return response()->json($departamento);
});

Route::get('/busca_departamento_id/{id}',function($id){
    $departamento = Departamentos::find($id);
    return response()->json($departamento);
});

Route::patch('/atualizar_departemento/{id}', function(Request $request, $id){
    $departamento = Departamentos::find($id);

    if ($request->input('name')!== null){
        $departamento->name = $request->input('name');
    }

    if ($request->input('description')!== null){
        $departamento->description = $request->input('description');
    }

    $departamento->save();
    return response()->json($departamento);
});

Route::delete('/deletar_departamento/{id}', function($id){
    $departamento = Departamentos::find($id);
    $departamento->delete();
    return response()->json($departamento);
});

/* Requisão do departamento com funcionarios */

Route::get('/departamentos/funcionarios/{id}', function ($id) {
    $departamento = Departamentos::with('funcionario')->find($id);
    return response()->json($departamento->funcionario);
});


Route::get('/funcionarios/departamento/{id}', function ($id) {
    $funcionario = Funcionario::find($id);
    return response()->json($funcionario->departamento);
});

Route::get('/departamentos/funcionarios/{id}', function ($id) {
    $departamento = Departamentos::find($id);
    return response()->json($departamento->funcionario);
});
