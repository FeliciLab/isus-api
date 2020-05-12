<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/projetos', 'Api\WordpressController@projetos');
Route::get('/buscaPorProjetos', 'Api\WordpressController@buscaPorProjetos');
Route::get('/categorias', 'Api\WordpressController@categorias');
Route::get('/projetosPorCategoria/{categoriaid}', 'Api\WordpressController@projetosPorCategoria');
Route::get('/projeto/{id}', 'Api\WordpressController@projetoPorId');
Route::get('/categoriasArquitetura', 'Api\WordpressController@categoriasArquitetura');

Route::get('/delay-textit/{segundos?}', function($segundos = 1) {
    sleep($segundos);
});

